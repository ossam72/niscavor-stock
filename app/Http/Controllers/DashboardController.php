public function dashboard()
{
    // 1. Calcul des statistiques pour les cartes bleues/vertes
    $totalBoissons = Drink::sum('quantite_stock');
    $nbProduits = Drink::count();
    $caTotal = Sale::sum('prix_total');

    // 2. Données pour le graphique (les 7 derniers jours)
    $salesData = Sale::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(prix_total) as total')
        )
        ->where('created_at', '>=', Carbon::now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

    $labels = [];
    $data = [];
    foreach($salesData as $sale) {
        $labels[] = Carbon::parse($sale->date)->format('d/m');
        $data[] = $sale->total;
    }

    // 3. RÉCUPÉRATION DES VENTES RÉCENTES (C'est ce qui manque !)
    $recentSales = Sale::with('drink')->latest()->take(5)->get();

    // 4. TRÈS IMPORTANT : Ajoute 'recentSales' dans le compact
    return view('dashboard', compact(
        'totalBoissons',
        'nbProduits',
        'caTotal',
        'labels',
        'data',
        'recentSales' // <--- IL DOIT ÊTRE ICI
    ));
}
