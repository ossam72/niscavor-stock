<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with('drink')->latest();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                  ->orWhereHas('drink', fn($d) => $d->where('nom', 'like', "%{$search}%"));
            });
        }

        if ($date = $request->get('date')) {
            $query->whereDate('created_at', $date);
        }

        $sales    = $query->paginate(15)->withQueryString();
        $caTotal  = Sale::sum('prix_total');
        $nbVentes = Sale::count();

        return view('sales.index', compact('sales', 'caTotal', 'nbVentes', 'search'));
    }

    public function store(Request $request)
    {
        if ($request->filled('cart_data')) {
            return $this->storeCart($request);
        }
        return $this->storeSingle($request);
    }

    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            if ($sale->drink) {
                $sale->drink->increment('quantite_stock', $sale->quantite_vendue);
            }
            $sale->delete();
        });

        return back()->with('success', 'Vente annulée et stock restitué.');
    }

    private function storeSingle(Request $request)
    {
        $request->validate([
            'drink_id'        => 'required|exists:drinks,id',
            'quantite_vendue' => 'required|integer|min:1',
            'client_name'     => 'nullable|string|max:255',
        ]);

        $drink = Drink::findOrFail($request->drink_id);

        if ($drink->quantite_stock < $request->quantite_vendue) {
            return back()->with('error',
                "Stock insuffisant pour {$drink->nom} (disponible : {$drink->quantite_stock})."
            );
        }

        DB::transaction(function () use ($drink, $request) {
            Sale::create([
                'drink_id'        => $drink->id,
                'client_name'     => $request->client_name ?? 'Anonyme',
                'quantite_vendue' => $request->quantite_vendue,
                'prix_total'      => $drink->prix_unitaire * $request->quantite_vendue,
            ]);
            $drink->decrement('quantite_stock', $request->quantite_vendue);
        });

        return back()->with('success',
            "Vente enregistrée : {$request->quantite_vendue}x {$drink->nom}."
        );
    }

    private function storeCart(Request $request)
    {
        $items      = json_decode($request->cart_data, true);
        $clientName = $request->client_name ?: 'Anonyme';
        $errors     = [];
        $created    = [];

        DB::transaction(function () use ($items, $clientName, &$errors, &$created) {
            foreach ($items as $item) {
                $drinkId = intval($item['drink_id'] ?? 0);
                $qty     = intval($item['quantite_vendue'] ?? 0);
                if ($drinkId <= 0 || $qty <= 0) continue;

                $drink = Drink::find($drinkId);
                if (!$drink) continue;

                if ($drink->quantite_stock < $qty) {
                    $errors[] = "Stock insuffisant pour {$drink->nom}.";
                    continue;
                }

                Sale::create([
                    'drink_id'        => $drink->id,
                    'client_name'     => $clientName,
                    'quantite_vendue' => $qty,
                    'prix_total'      => $drink->prix_unitaire * $qty,
                ]);
                $drink->decrement('quantite_stock', $qty);
                $created[] = "{$qty}x {$drink->nom}";
            }
        });

        if (!empty($errors)) {
            return back()->with('error', implode(' | ', $errors));
        }
        return back()->with('success',
            "Vente enregistrée pour {$clientName} — " . implode(', ', $created) . '.'
        );
    }
}
