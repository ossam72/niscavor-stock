<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion des Ventes — Niscavor</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700;800;900&family=Figtree:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        :root{--black:#0a0a0a;--gold:#F5A623;--gold2:#FFD166;--gold-soft:rgba(245,166,35,.12);--green:#06C167;--red:#FF4D4F;--blue:#3B82F6;--bg:#F7F6F2;--card:#fff;--navy:#111827;--muted:#6B7280;--border:#E5E7EB;--r:14px;}
        body{font-family:'Figtree',sans-serif;background:var(--bg);color:var(--navy);}
        h1,h2,h3{font-family:'Barlow',sans-serif;}
        nav{background:var(--black);height:60px;display:flex;align-items:center;justify-content:space-between;padding:0 28px;border-bottom:2px solid var(--gold);position:sticky;top:0;z-index:100;}
        .brand{font-family:'Barlow',sans-serif;font-size:21px;font-weight:900;color:#fff;text-decoration:none;}
        .brand em{color:var(--gold);font-style:normal;}
        .nav-r{display:flex;align-items:center;gap:18px;}
        .nav-link{color:rgba(255,255,255,.55);font-size:14px;font-weight:600;text-decoration:none;transition:.2s;}
        .nav-link:hover,.nav-link.active{color:var(--gold);}
        .nav-av{width:34px;height:34px;border-radius:50%;background:var(--gold);color:var(--black);font-size:13px;font-weight:800;display:flex;align-items:center;justify-content:center;text-decoration:none;}
        .layout{display:grid;grid-template-columns:210px 1fr;min-height:calc(100vh - 60px);}
        .sidebar{background:var(--black);padding:20px 14px;border-right:1px solid rgba(255,255,255,.06);}
        .sb-lbl{font-size:10px;font-weight:700;color:rgba(255,255,255,.22);letter-spacing:2px;text-transform:uppercase;margin:18px 8px 8px;}
        .sb-link{display:flex;align-items:center;gap:9px;padding:9px 11px;border-radius:9px;font-size:14px;font-weight:600;color:rgba(255,255,255,.52);text-decoration:none;cursor:pointer;margin-bottom:2px;transition:.18s;border:none;background:none;width:100%;text-align:left;}
        .sb-link:hover{background:rgba(255,255,255,.06);color:#fff;}
        .sb-link.active{background:var(--gold-soft);color:var(--gold);}
        .sb-ico{font-size:15px;width:20px;text-align:center;}
        .sb-user{display:flex;align-items:center;gap:9px;padding:11px 10px;margin:4px 0 8px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:9px;}
        .sb-av{width:33px;height:33px;border-radius:50%;background:var(--gold);color:var(--black);font-family:'Barlow',sans-serif;font-size:13px;font-weight:800;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
        .sb-name{font-size:13px;font-weight:700;color:#fff;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
        .sb-email{font-size:11px;color:rgba(255,255,255,.35);overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:130px;}
        .sb-danger:hover{background:rgba(255,77,79,.12)!important;color:var(--red)!important;}
        .main{padding:28px 24px;}
        .page-hd{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;flex-wrap:wrap;gap:12px;}
        .page-title{font-size:26px;font-weight:800;color:var(--navy);letter-spacing:-.3px;}
        .page-sub{font-size:13px;color:var(--muted);margin-top:3px;}
        .kpi-row{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:22px;}
        .kpi{background:var(--card);border-radius:var(--r);border:1px solid var(--border);padding:18px;position:relative;overflow:hidden;}
        .kpi-acc{position:absolute;top:0;left:0;right:0;height:3px;}
        .kpi-lbl{font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:1.2px;margin-bottom:5px;}
        .kpi-val{font-family:'Barlow',sans-serif;font-size:30px;font-weight:800;color:var(--navy);letter-spacing:-1px;line-height:1;}
        .kpi-ft{font-size:12px;color:var(--muted);margin-top:6px;}
        .filters{background:var(--card);border-radius:var(--r);border:1px solid var(--border);padding:16px 20px;margin-bottom:18px;display:flex;gap:12px;flex-wrap:wrap;align-items:flex-end;}
        .f-group{display:flex;flex-direction:column;gap:5px;flex:1;min-width:160px;}
        .f-label{font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:1px;}
        .f-input{padding:9px 13px;border:1px solid var(--border);border-radius:9px;font-family:'Figtree',sans-serif;font-size:14px;color:var(--navy);background:#fff;outline:none;transition:.2s;}
        .f-input:focus{border-color:var(--gold);box-shadow:0 0 0 3px var(--gold-soft);}
        .btn-filter{padding:9px 22px;background:var(--navy);color:var(--gold);font-family:'Barlow',sans-serif;font-weight:700;font-size:14px;border:none;border-radius:9px;cursor:pointer;transition:.2s;white-space:nowrap;}
        .btn-filter:hover{background:var(--gold);color:var(--navy);}
        .btn-reset{padding:9px 16px;background:transparent;color:var(--muted);font-family:'Figtree',sans-serif;font-size:13px;border:1px solid var(--border);border-radius:9px;cursor:pointer;transition:.2s;text-decoration:none;display:inline-flex;align-items:center;}
        .btn-reset:hover{border-color:var(--red);color:var(--red);}
        .panel{background:var(--card);border-radius:var(--r);border:1px solid var(--border);overflow:hidden;}
        .panel-head{padding:14px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
        .panel-head-l{display:flex;align-items:center;gap:9px;}
        .ph-ico{width:30px;height:30px;border-radius:8px;background:var(--gold-soft);color:var(--gold);display:flex;align-items:center;justify-content:center;font-size:14px;}
        .ph-title{font-family:'Barlow',sans-serif;font-size:15px;font-weight:800;color:var(--navy);}
        .ph-sub{font-size:11px;color:var(--muted);}
        .pill{font-size:11px;font-weight:700;padding:3px 11px;border-radius:20px;background:var(--navy);color:var(--gold);}
        table{width:100%;border-collapse:collapse;}
        thead th{background:#F9FAFB;font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:1px;padding:11px 16px;border-bottom:1px solid var(--border);text-align:left;}
        tbody td{padding:13px 16px;border-bottom:1px solid #F9FAFB;font-size:14px;vertical-align:middle;}
        tbody tr:last-child td{border-bottom:none;}
        tbody tr:hover td{background:rgba(245,166,35,.025);}
        .chip{font-size:11px;font-weight:700;padding:3px 9px;border-radius:20px;}
        .chip-date{background:#F3F4F6;color:var(--muted);}
        .chip-client{background:var(--black);color:var(--gold);}
        .chip-qty{background:rgba(59,130,246,.1);color:#2563EB;}
        .chip-amt{font-family:'Barlow',sans-serif;font-weight:800;color:var(--green);font-size:15px;}
        .drink-name{font-weight:700;color:var(--navy);}
        .btn-del{background:rgba(255,77,79,.08);color:var(--red);border:1px solid rgba(255,77,79,.2);font-size:12px;font-weight:700;padding:5px 12px;border-radius:8px;cursor:pointer;transition:.2s;font-family:'Figtree',sans-serif;}
        .btn-del:hover{background:var(--red);color:#fff;}
        .alert{padding:12px 16px;border-radius:10px;font-size:14px;font-weight:600;margin-bottom:16px;}
        .alert-success{background:rgba(6,193,103,.1);color:#065F46;border:1px solid rgba(6,193,103,.25);}
        .alert-error{background:rgba(255,77,79,.1);color:#9B1C1C;border:1px solid rgba(255,77,79,.25);}
        .empty{text-align:center;padding:48px 16px;color:var(--muted);}
        .empty-icon{font-size:40px;display:block;margin-bottom:12px;opacity:.3;}
        .pagination-wrap{padding:14px 20px;border-top:1px solid var(--border);}
        @media(max-width:768px){.layout{grid-template-columns:1fr;}.sidebar{display:none;}.kpi-row{grid-template-columns:1fr 1fr;}thead{display:none;}tbody tr{display:block;margin:.5rem;border-radius:10px;border:1px solid var(--border)!important;}tbody td{display:flex;justify-content:space-between;align-items:center;padding:9px 13px;border-bottom:1px solid #f1f5f9;}tbody td::before{content:attr(data-label);font-size:10px;font-weight:700;color:var(--muted);text-transform:uppercase;}}
        @media(max-width:480px){.kpi-row{grid-template-columns:1fr;}}
    </style>
</head>
<body>

<nav>
    <a href="{{ route('dashboard') }}" class="brand">Nisca<em>vor</em></a>
    <div class="nav-r">
        <a href="{{ route('dashboard') }}" class="nav-link">Tableau de bord</a>
        <a href="{{ route('drinks.index') }}" class="nav-link">Cave</a>
        <a href="{{ route('sales.index') }}" class="nav-link active">Ventes</a>
        <a href="{{ route('users.index') }}" class="nav-link">Utilisateurs</a>
        <a href="{{ route('profile.edit') }}" class="nav-av">
            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
        </a>
    </div>
</nav>

<div class="layout">
    <aside class="sidebar">
        <div class="sb-lbl">Menu</div>
        <a href="{{ route('dashboard') }}" class="sb-link"><span class="sb-ico">🏠</span> Tableau de bord</a>
        <a href="{{ route('drinks.index') }}" class="sb-link"><span class="sb-ico">🍾</span> Gestion Cave</a>
        <a href="{{ route('sales.index') }}" class="sb-link active"><span class="sb-ico">🛒</span> Ventes</a>
        <a href="{{ route('users.index') }}" class="sb-link"><span class="sb-ico">👥</span> Utilisateurs</a>
        <div class="sb-lbl">Compte</div>
        <div class="sb-user">
            <div class="sb-av">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div class="sb-name">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                <div class="sb-email">{{ Auth::user()->email ?? '' }}</div>
            </div>
        </div>
        <a href="{{ route('profile.edit') }}" class="sb-link"><span class="sb-ico">👤</span> Mon Profil</a>
        <form method="POST" action="{{ route('logout') }}" style="margin:0">
            @csrf
            <button type="submit" class="sb-link sb-danger"><span class="sb-ico">🚪</span> Déconnexion</button>
        </form>
    </aside>

    <main class="main">
        <div class="page-hd">
            <div>
                <div class="page-title">🛒 Gestion des Ventes</div>
                <div class="page-sub">Historique complet — recherche et suppression</div>
            </div>
            <a href="{{ route('drinks.index') }}" style="display:inline-flex;align-items:center;gap:7px;background:var(--navy);border:2px solid var(--gold);color:var(--gold);font-family:'Barlow',sans-serif;font-weight:800;font-size:14px;padding:10px 24px;border-radius:50px;text-decoration:none;">
                ⚡ Nouvelle Vente
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="kpi-row">
            <div class="kpi">
                <div class="kpi-acc" style="background:linear-gradient(90deg,var(--green),#34D399)"></div>
                <div class="kpi-lbl">CA Total</div>
                <div class="kpi-val" style="font-size:22px;">{{ number_format($caTotal, 0, ',', ' ') }}</div>
                <div class="kpi-ft">💵 FCFA cumulé</div>
            </div>
            <div class="kpi">
                <div class="kpi-acc" style="background:linear-gradient(90deg,var(--blue),#60A5FA)"></div>
                <div class="kpi-lbl">Nb Ventes</div>
                <div class="kpi-val">{{ number_format($nbVentes, 0, ',', ' ') }}</div>
                <div class="kpi-ft">🧾 transactions totales</div>
            </div>
            <div class="kpi">
                <div class="kpi-acc" style="background:linear-gradient(90deg,var(--gold),var(--gold2))"></div>
                <div class="kpi-lbl">Cette page</div>
                <div class="kpi-val">{{ $sales->count() }}</div>
                <div class="kpi-ft">📄 sur {{ $sales->total() }} résultats</div>
            </div>
        </div>

        <form method="GET" action="{{ route('sales.index') }}">
            <div class="filters">
                <div class="f-group">
                    <label class="f-label">Recherche</label>
                    <input type="text" name="search" class="f-input" placeholder="Client ou produit…" value="{{ $search ?? '' }}">
                </div>
                <div class="f-group" style="max-width:180px;">
                    <label class="f-label">Date</label>
                    <input type="date" name="date" class="f-input" value="{{ request('date') }}">
                </div>
                <button type="submit" class="btn-filter">🔍 Filtrer</button>
                <a href="{{ route('sales.index') }}" class="btn-reset">✕ Réinitialiser</a>
            </div>
        </form>

        <div class="panel">
            <div class="panel-head">
                <div class="panel-head-l">
                    <div class="ph-ico">🧾</div>
                    <div>
                        <div class="ph-title">Historique des Ventes</div>
                        <div class="ph-sub">Toutes les transactions enregistrées</div>
                    </div>
                </div>
                <span class="pill">{{ $sales->total() }} ventes</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>#</th><th>Date</th><th>Client</th>
                        <th>Produit</th><th>Qté</th>
                        <th style="text-align:right">Montant</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td data-label="#"><span style="font-size:12px;color:var(--muted);font-weight:600;">#{{ $sale->id }}</span></td>
                        <td data-label="Date"><span class="chip chip-date">{{ $sale->created_at->format('d/m/Y H:i') }}</span></td>
                        <td data-label="Client"><span class="chip chip-client">{{ $sale->client_name ?? 'Anonyme' }}</span></td>
                        <td data-label="Produit"><span class="drink-name">{{ $sale->drink->nom ?? '⚠️ Supprimé' }}</span></td>
                        <td data-label="Qté"><span class="chip chip-qty">× {{ $sale->quantite_vendue }}</span></td>
                        <td data-label="Montant" style="text-align:right"><span class="chip-amt">{{ number_format($sale->prix_total, 0, ',', ' ') }} F</span></td>
                        <td data-label="Action" style="text-align:center">
                            <form method="POST" action="{{ route('sales.destroy', $sale) }}" onsubmit="return confirm('Annuler cette vente et restituer le stock ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-del">🗑️ Annuler</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty">
                                <span class="empty-icon">📭</span>
                                Aucune vente trouvée.
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            @if($sales->hasPages())
            <div class="pagination-wrap">{{ $sales->links() }}</div>
            @endif
        </div>
    </main>
</div>

</body>
</html>
