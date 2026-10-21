<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

/**
 * DrinkController — Design Pattern MVC
 * Toute la logique métier est ici, les vues n'affichent que les données.
 */
class DrinkController extends Controller
{
    // ──────────────────────────────────────────────
    //  DASHBOARD
    // ──────────────────────────────────────────────
    public function dashboard()
    {
        $totalBoissons = Drink::sum('quantite_stock');
        $nbProduits    = Drink::count();
        $caTotal       = Sale::sum('prix_total');

        $salesData = Sale::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(prix_total) as total')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $labels = [];
        $data   = [];
        foreach ($salesData as $sale) {
            $labels[] = Carbon::parse($sale->date)->format('d/m');
            $data[]   = $sale->total;
        }

        $recentSales = Sale::with('drink')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalBoissons', 'nbProduits', 'caTotal',
            'labels', 'data', 'recentSales'
        ));
    }

    // ──────────────────────────────────────────────
    //  INDEX — liste avec recherche
    // ──────────────────────────────────────────────
    public function index(Request $request)
    {
        $search = $request->input('search');

        $drinks = Drink::when($search, function ($query, $search) {
            $query->where('nom', 'like', "%{$search}%")
                  ->orWhere('categorie', 'like', "%{$search}%");
        })->get();

        return view('drinks.index', compact('drinks'));
    }

    // ──────────────────────────────────────────────
    //  CREATE
    // ──────────────────────────────────────────────
    public function create()
    {
        return view('drinks.create');
    }

    // ──────────────────────────────────────────────
    //  STORE — avec upload photo
    // ──────────────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:255',
            'categorie'      => 'required|string',
            'quantite_stock' => 'required|integer|min:0',
            'prix_unitaire'  => 'required|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload de la photo (Pattern Repository : stockage centralisé)
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('drinks', 'public');   // → storage/app/public/drinks/
        }

        Drink::create($validated);

        return redirect()->route('drinks.index')
            ->with('success', "✅ {$validated['nom']} ajouté avec succès !");
    }

    // ──────────────────────────────────────────────
    //  EDIT
    // ──────────────────────────────────────────────
    public function edit(Drink $drink)
    {
        return view('drinks.edit', compact('drink'));
    }

    // ──────────────────────────────────────────────
    //  UPDATE — avec remplacement de photo
    // ──────────────────────────────────────────────
    public function update(Request $request, Drink $drink)
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:255',
            'categorie'      => 'required|string',
            'quantite_stock' => 'required|integer|min:0',
            'prix_unitaire'  => 'required|numeric|min:0',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Nouvelle photo → on supprime l'ancienne
        if ($request->hasFile('image')) {
            if ($drink->image) {
                Storage::disk('public')->delete($drink->image);
            }
            $validated['image'] = $request->file('image')
                ->store('drinks', 'public');
        }

        // Suppression de la photo sans remplacement
        if ($request->boolean('remove_image') && $drink->image) {
            Storage::disk('public')->delete($drink->image);
            $validated['image'] = null;
        }

        $drink->update($validated);

        return redirect()->route('drinks.index')
            ->with('success', "✏️ {$drink->nom} mis à jour !");
    }

    // ──────────────────────────────────────────────
    //  DESTROY — supprime aussi la photo
    // ──────────────────────────────────────────────
    public function destroy(Drink $drink)
    {
        if ($drink->image) {
            Storage::disk('public')->delete($drink->image);
        }

        $nom = $drink->nom;
        $drink->delete();

        return redirect()->route('drinks.index')
            ->with('success', "🗑️ {$nom} retiré de la cave.");
    }
}
