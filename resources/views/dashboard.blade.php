{{--
    NISCAVOR — Dashboard Premium
    Design : black/gold/navy | Fonts : Barlow + Figtree
--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tableau de Bord — Niscavor</title>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@500;600;700;800;900&family=Figtree:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --black:#0a0a0a; --white:#ffffff; --gold:#F5A623; --gold2:#FFD166;
            --gold-soft:rgba(245,166,35,.12); --gold-glow:rgba(245,166,35,.35);
            --green:#06C167; --red:#FF4D4F; --blue:#3B82F6;
            --bg:#F7F6F2; --card:#ffffff; --navy:#111827; --muted:#6B7280; --border:#E5E7EB;
            --r-sm:10px; --r-md:16px; --r-lg:20px;
            --sh-lg:0 12px 40px rgba(0,0,0,.13);
        }
        html, body { font-family:'Figtree',sans-serif; background:var(--bg); color:var(--navy); min-height:100vh; }
        h1,h2,h3,h4,h5,h6 { font-family:'Barlow',sans-serif; }

        /* NAVBAR */
        .nv-navbar { background:var(--black); height:64px; display:flex; align-items:center; justify-content:space-between; padding:0 28px; position:sticky; top:0; z-index:100; border-bottom:2px solid var(--gold); }
        .nv-brand { font-family:'Barlow',sans-serif; font-size:22px; font-weight:900; color:#fff; text-decoration:none; }
        .nv-brand em { color:var(--gold); font-style:normal; }
        .nv-right { display:flex; align-items:center; gap:20px; }
        .nv-date { font-size:12px; color:rgba(255,255,255,.45); font-weight:600; background:rgba(255,255,255,.06); padding:5px 14px; border-radius:20px; border:1px solid rgba(255,255,255,.1); }
        .nv-link { color:rgba(255,255,255,.55); font-size:14px; font-weight:600; text-decoration:none; transition:color .2s; }
        .nv-link:hover, .nv-link.active { color:var(--gold); }
        .nv-avatar { width:36px; height:36px; border-radius:50%; background:var(--gold); color:var(--black); font-size:13px; font-weight:800; display:flex; align-items:center; justify-content:center; text-decoration:none; }

        /* LAYOUT */
        .nv-layout { display:grid; grid-template-columns:220px 1fr; min-height:calc(100vh - 64px); }

        /* SIDEBAR */
        .nv-sidebar { background:var(--black); padding:24px 14px; border-right:1px solid rgba(255,255,255,.06); position:sticky; top:64px; height:calc(100vh - 64px); overflow-y:auto; }
        .sb-label { font-size:10px; font-weight:800; color:rgba(255,255,255,.22); letter-spacing:2px; text-transform:uppercase; margin:20px 8px 10px; }
        .sb-link { display:flex; align-items:center; gap:10px; padding:10px 12px; border-radius:var(--r-sm); font-size:13px; font-weight:600; color:rgba(255,255,255,.52); text-decoration:none; transition:background .18s,color .18s; margin-bottom:2px; border:none; background:none; width:100%; text-align:left; cursor:pointer; }
        .sb-link:hover { background:rgba(255,255,255,.06); color:#fff; }
        .sb-link.active { background:var(--gold-soft); color:var(--gold); }
        .sb-ico { font-size:16px; width:20px; text-align:center; flex-shrink:0; }
        .sb-user-card { display:flex; align-items:center; gap:10px; padding:12px 10px; margin:4px 0 8px; background:rgba(255,255,255,.05); border:1px solid rgba(255,255,255,.08); border-radius:var(--r-sm); }
        .sb-user-av { width:34px; height:34px; border-radius:50%; background:var(--gold); color:var(--black); font-family:'Barlow',sans-serif; font-size:14px; font-weight:800; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .sb-user-name { font-size:13px; font-weight:700; color:#fff; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .sb-user-email { font-size:11px; color:rgba(255,255,255,.35); font-weight:500; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; max-width:140px; }
        .sb-link-danger:hover { background:rgba(255,77,79,.12) !important; color:var(--red) !important; }

        /* MAIN */
        .nv-main { padding:32px 28px; overflow-y:auto; }
        .page-title { font-family:'Barlow',sans-serif; font-size:26px; font-weight:800; color:var(--navy); margin-bottom:4px; letter-spacing:-.3px; }
        .page-sub { font-size:13px; color:var(--muted); font-weight:500; margin-bottom:28px; display:flex; align-items:center; gap:8px; }
        .live-dot { width:7px; height:7px; background:var(--green); border-radius:50%; display:inline-block; flex-shrink:0; animation:blink 2s ease-in-out infinite; }
        @keyframes blink { 0%,100%{opacity:1;box-shadow:0 0 0 0 rgba(6,193,103,.5);} 50%{opacity:.6;box-shadow:0 0 0 6px rgba(6,193,103,0);} }

        /* KPI */
        .kpi-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:24px; }
        .kpi-card { background:var(--card); border-radius:var(--r-lg); border:1px solid var(--border); padding:20px; position:relative; overflow:hidden; transition:transform .25s,box-shadow .25s; }
        .kpi-card:hover { transform:translateY(-3px); box-shadow:var(--sh-lg); }
        .kpi-accent { position:absolute; top:0; left:0; right:0; height:3px; }
        .kpi-top { display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:16px; }
        .kpi-icon { width:42px; height:42px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0; }
        .kpi-chip { font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; }
        .kpi-label { font-size:11px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:1.2px; margin-bottom:6px; }
        .kpi-value { font-family:'Barlow',sans-serif; font-size:32px; font-weight:800; color:var(--navy); letter-spacing:-1px; line-height:1; }
        .kpi-foot { font-size:13px; color:var(--muted); font-weight:500; margin-top:8px; }

        /* PANELS */
        .panels-row { display:grid; grid-template-columns:1fr 320px; gap:16px; margin-bottom:24px; }
        .panel { background:var(--card); border-radius:var(--r-lg); border:1px solid var(--border); overflow:hidden; }
        .panel-head { padding:16px 20px; border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; }
        .panel-head-left { display:flex; align-items:center; gap:10px; }
        .panel-ico { width:32px; height:32px; border-radius:8px; background:var(--gold-soft); color:var(--gold); display:flex; align-items:center; justify-content:center; font-size:15px; }
        .panel-title { font-family:'Barlow',sans-serif; font-size:15px; font-weight:800; color:var(--navy); }
        .panel-sub { font-size:11px; color:var(--muted); font-weight:500; margin-top:1px; }
        .panel-pill { font-size:11px; font-weight:700; padding:4px 12px; border-radius:20px; background:var(--navy); color:var(--gold); }
        .panel-body { padding:20px; }

        /* CHART */
        .chart-area { display:flex; align-items:flex-end; gap:8px; height:160px; margin-bottom:12px; }
        .bar-wrap { flex:1; display:flex; flex-direction:column; align-items:center; gap:6px; }
        .bar { width:100%; border-radius:6px 6px 0 0; min-height:4px; }
        .bar-lbl { font-size:10px; color:var(--muted); font-weight:600; }
        .chart-legend { display:flex; gap:16px; margin-top:12px; }
        .legend-item { display:flex; align-items:center; gap:6px; font-size:11px; color:var(--muted); font-weight:600; }
        .legend-dot { width:8px; height:8px; border-radius:50%; flex-shrink:0; }

        /* CA PANEL */
        .ca-total-bloc { background:var(--black); border-radius:12px; padding:16px; margin-bottom:14px; }
        .ca-live { display:flex; align-items:center; gap:6px; margin-bottom:8px; }
        .ca-live span { font-size:10px; font-weight:700; color:rgba(255,255,255,.4); text-transform:uppercase; letter-spacing:1px; }
        .ca-val { font-family:'Barlow',sans-serif; font-size:28px; font-weight:800; color:var(--gold); letter-spacing:-1px; }
        .ca-sub { font-size:11px; color:rgba(255,255,255,.3); font-weight:600; margin-top:2px; }
        .week-bloc { background:#F9FAFB; border-radius:12px; padding:14px; margin-bottom:12px; }
        .week-top { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; }
        .week-lbl { font-size:11px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:1px; }
        .week-pct { font-size:12px; font-weight:800; color:var(--navy); }
        .week-val { font-family:'Barlow',sans-serif; font-size:20px; font-weight:800; color:var(--navy); margin-bottom:8px; }
        .prog { height:5px; background:var(--border); border-radius:20px; overflow:hidden; }
        .prog-fill { height:100%; border-radius:20px; background:linear-gradient(90deg,var(--gold),var(--gold2)); }
        .best-day-bloc { display:flex; align-items:center; gap:10px; background:#FFFBF0; border:1px solid rgba(245,166,35,.25); border-radius:12px; padding:12px 14px; }
        .best-day-txt .lbl { font-size:10px; font-weight:800; color:var(--gold); text-transform:uppercase; letter-spacing:1px; }
        .best-day-txt .val { font-family:'Barlow',sans-serif; font-size:13px; font-weight:800; color:var(--navy); margin-top:2px; }

        /* TABLE VENTES */
        .sales-panel { background:var(--card); border-radius:var(--r-lg); border:1px solid var(--border); overflow:hidden; margin-bottom:24px; }
        .data-table { width:100%; border-collapse:collapse; }
        .data-table thead th { background:#F9FAFB; font-size:11px; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:1.2px; padding:12px 18px; border-bottom:1px solid var(--border); text-align:left; }
        .data-table tbody td { padding:14px 18px; border-bottom:1px solid #F9FAFB; font-size:14px; font-weight:500; vertical-align:middle; }
        .data-table tbody tr:last-child td { border-bottom:none; }
        .data-table tbody tr:hover td { background:rgba(245,166,35,.025); }
        .chip { font-size:12px; font-weight:700; padding:4px 10px; border-radius:20px; }
        .chip-date { background:#F3F4F6; color:var(--muted); }
        .chip-client { background:var(--black); color:var(--gold); }
        .chip-qty { background:rgba(59,130,246,.1); color:#2563EB; }
        .chip-amt { font-family:'Barlow',sans-serif; font-weight:800; color:var(--green); font-size:15px; }
        .drink-name { font-weight:700; color:var(--navy); }
        .empty-state { text-align:center; padding:48px 16px; color:var(--muted); }
        .empty-state .icon { font-size:40px; display:block; margin-bottom:12px; opacity:.35; }

        /* CTA */
        .cta-wrap { text-align:center; padding:8px 0 24px; }
        .btn-cta { display:inline-flex; align-items:center; gap:8px; background:var(--black); border:2px solid var(--gold); color:var(--gold); font-family:'Barlow',sans-serif; font-weight:800; font-size:14px; padding:12px 32px; border-radius:50px; text-decoration:none; transition:background .25s,color .25s,transform .25s; }
        .btn-cta:hover { background:var(--gold); color:var(--black); transform:translateY(-2px); }

        /* RESPONSIVE */
        @media(max-width:1024px) { .panels-row { grid-template-columns:1fr; } }
        @media(max-width:768px) {
            .nv-layout { grid-template-columns:1fr; }
            .nv-sidebar { display:none; }
            .kpi-grid { grid-template-columns:1fr 1fr; }
            .nv-main { padding:20px 16px; }
            .data-table thead { display:none; }
            .data-table tbody tr { display:block; margin:.5rem; border-radius:var(--r-sm); border:1px solid var(--border) !important; }
            .data-table td { display:flex; justify-content:space-between; align-items:center; padding:10px 14px; border-bottom:1px solid #f1f5f9; }
            .data-table td::before { content:attr(data-label); font-size:10px; font-weight:700; color:var(--muted); text-transform:uppercase; }
        }
        @media(max-width:480px) { .kpi-grid { grid-template-columns:1fr; } .nv-right .nv-link { display:none; } }
    </style>

    <nav class="nv-navbar">
        <a href="{{ route('dashboard') }}" class="nv-brand">Nisca<em>vor</em></a>
        <div class="nv-right">
            <span class="nv-date">📅 {{ now()->isoFormat('ddd D MMM YYYY') }}</span>
            <a href="{{ route('dashboard') }}" class="nv-link active">Tableau de bord</a>
            <a href="{{ route('drinks.index') }}" class="nv-link">Cave</a>
            <a href="{{ route('sales.index') }}" class="nv-link">Ventes</a>
            <a href="{{ route('users.index') }}" class="nv-link">Utilisateurs</a>
            <a href="{{ route('profile.edit') }}" class="nv-link">Profil</a>
            <a href="{{ route('profile.edit') }}" class="nv-avatar">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
            </a>
        </div>
    </nav>

    <div class="nv-layout">
        <aside class="nv-sidebar">
            <div class="sb-label">Menu</div>
            <a href="{{ route('dashboard') }}" class="sb-link active"><span class="sb-ico">🏠</span> Tableau de bord</a>
            <a href="{{ route('drinks.index') }}" class="sb-link"><span class="sb-ico">🍾</span> Gestion Cave</a>
            <a href="{{ route('sales.index') }}" class="sb-link"><span class="sb-ico">🛒</span> Ventes</a>
            <a href="{{ route('users.index') }}" class="sb-link"><span class="sb-ico">👥</span> Utilisateurs</a>

            <div class="sb-label">Compte</div>
            <div class="sb-user-card">
                <div class="sb-user-av">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                <div>
                    <div class="sb-user-name">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                    <div class="sb-user-email">{{ Auth::user()->email ?? '' }}</div>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}" class="sb-link"><span class="sb-ico">👤</span> Mon Profil</a>
            <form method="POST" action="{{ route('logout') }}" style="margin:0">
                @csrf
                <button type="submit" class="sb-link sb-link-danger">
                    <span class="sb-ico">🚪</span> Déconnexion
                </button>
            </form>
        </aside>

        <main class="nv-main">
            <div class="page-title">Tableau de Bord</div>
            <div class="page-sub">
                <span class="live-dot"></span>
                Vue d'ensemble de votre activité — mis à jour en temps réel
            </div>

            {{-- KPI CARDS --}}
            <div class="kpi-grid">
                <div class="kpi-card">
                    <div class="kpi-accent" style="background:linear-gradient(90deg,#3B82F6,#60A5FA)"></div>
                    <div class="kpi-top">
                        <div class="kpi-icon" style="background:rgba(59,130,246,.1);color:#3B82F6;">📦</div>
                        <span class="kpi-chip" style="background:rgba(59,130,246,.1);color:#2563EB;">Stock</span>
                    </div>
                    <div class="kpi-label">Stock Total</div>
                    <div class="kpi-value">{{ number_format($totalBoissons ?? 0, 0, ',', ' ') }}</div>
                    <div class="kpi-foot">🏪 unités disponibles en cave</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-accent" style="background:linear-gradient(90deg,var(--gold),var(--gold2))"></div>
                    <div class="kpi-top">
                        <div class="kpi-icon" style="background:var(--gold-soft);color:var(--gold);">🍾</div>
                        <span class="kpi-chip" style="background:var(--gold-soft);color:#B45309;">Catalogue</span>
                    </div>
                    <div class="kpi-label">Références</div>
                    <div class="kpi-value">{{ $nbProduits ?? 0 }}</div>
                    <div class="kpi-foot">🗂️ modèles distincts</div>
                </div>

                <div class="kpi-card">
                    <div class="kpi-accent" style="background:linear-gradient(90deg,var(--green),#34D399)"></div>
                    <div class="kpi-top">
                        <div class="kpi-icon" style="background:rgba(6,193,103,.1);color:var(--green);">💰</div>
                        <span class="kpi-chip" style="background:rgba(6,193,103,.1);color:#065F46;">Cumul</span>
                    </div>
                    <div class="kpi-label">Chiffre d'Affaires</div>
                    <div class="kpi-value" style="font-size:22px;">{{ number_format($caTotal ?? 0, 0, ',', ' ') }}</div>
                    <div class="kpi-foot">💵 FCFA — total cumulé</div>
                </div>
            </div>

            {{-- CHART + CA --}}
            <div class="panels-row">
                <div class="panel">
                    <div class="panel-head">
                        <div class="panel-head-left">
                            <div class="panel-ico">📊</div>
                            <div>
                                <div class="panel-title">Évolution des Ventes</div>
                                <div class="panel-sub">Chiffre d'affaires sur 7 jours</div>
                            </div>
                        </div>
                        <span class="panel-pill">7 jours</span>
                    </div>
                    <div class="panel-body">
                        <div class="chart-area" id="barChart"></div>
                        <div class="chart-legend">
                            <div class="legend-item"><div class="legend-dot" style="background:var(--gold)"></div>Ventes (FCFA)</div>
                            <div class="legend-item"><div class="legend-dot" style="background:var(--green)"></div>Meilleur jour</div>
                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-head">
                        <div class="panel-head-left">
                            <div class="panel-ico">⚡</div>
                            <div>
                                <div class="panel-title">Analyse CA</div>
                                <div class="panel-sub">Performance financière</div>
                            </div>
                        </div>
                        <span class="panel-pill" style="background:var(--green);color:#fff;">
                            <span class="live-dot" style="margin-right:4px;"></span>Live
                        </span>
                    </div>
                    <div class="panel-body" style="padding:16px;">
                        <div class="ca-total-bloc">
                            <div class="ca-live">
                                <div class="live-dot"></div>
                                <span>CA Total Cumulé</span>
                            </div>
                            <div class="ca-val">{{ number_format($caTotal ?? 0, 0, ',', ' ') }} FCFA</div>
                            <div class="ca-sub">Depuis le lancement</div>
                        </div>

                        @php
                            $caWeek = collect($data ?? [])->sum();
                            $caPerc = ($caTotal > 0) ? min(round(($caWeek / $caTotal) * 100, 1), 100) : 0;
                        @endphp
                        <div class="week-bloc">
                            <div class="week-top">
                                <span class="week-lbl">7 derniers jours</span>
                                <span class="week-pct">{{ $caPerc }}%</span>
                            </div>
                            <div class="week-val">{{ number_format($caWeek, 0, ',', ' ') }} FCFA</div>
                            <div class="prog"><div class="prog-fill" style="width:{{ $caPerc }}%"></div></div>
                        </div>

                        @if(!empty($data) && max($data ?? [0]) > 0)
                        @php
                            $maxI  = array_search(max($data), $data);
                            $bestD = $labels[$maxI] ?? '—';
                            $bestA = max($data);
                        @endphp
                        <div class="best-day-bloc">
                            <span style="font-size:20px;">🏆</span>
                            <div class="best-day-txt">
                                <div class="lbl">Meilleur Jour</div>
                                <div class="val">{{ $bestD }} — {{ number_format($bestA, 0, ',', ' ') }} FCFA</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- DERNIÈRES VENTES --}}
            <div class="sales-panel">
                <div class="panel-head">
                    <div class="panel-head-left">
                        <div class="panel-ico">🧾</div>
                        <div>
                            <div class="panel-title">Dernières Ventes</div>
                            <div class="panel-sub">Transactions récentes</div>
                        </div>
                    </div>
                    <span class="panel-pill">5 récentes</span>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Date</th><th>Client</th><th>Produit</th><th>Qté</th>
                            <th style="text-align:right">Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($recentSales as $sale)
                        <tr>
                            <td data-label="Date"><span class="chip chip-date">{{ $sale->created_at->format('d/m H:i') }}</span></td>
                            <td data-label="Client"><span class="chip chip-client">{{ $sale->client_name ?? 'Anonyme' }}</span></td>
                            <td data-label="Produit"><span class="drink-name">{{ $sale->drink->nom ?? 'Supprimé' }}</span></td>
                            <td data-label="Qté"><span class="chip chip-qty">× {{ $sale->quantite_vendue }}</span></td>
                            <td data-label="Montant" style="text-align:right"><span class="chip-amt">{{ number_format($sale->prix_total, 0, ',', ' ') }} F</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <span class="icon">📭</span>
                                    Aucune vente enregistrée pour le moment.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="cta-wrap">
                <a href="{{ route('drinks.index') }}" class="btn-cta">⚡ Ouvrir la Gestion de Cave</a>
            </div>
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const labels = {!! json_encode($labels ?? ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim']) !!};
        const vals   = {!! json_encode($data   ?? []) !!};
        const chart  = document.getElementById('barChart');
        if (!chart || !vals.length) return;
        const maxVal = Math.max(...vals) || 1;
        const maxIdx = vals.indexOf(maxVal);
        chart.innerHTML = vals.map((v, i) => {
            const h    = Math.max(Math.round((v / maxVal) * 140), 4);
            const best = i === maxIdx;
            const bg   = best ? 'linear-gradient(180deg,var(--green),#04a857)' : 'linear-gradient(180deg,var(--gold),rgba(245,166,35,.2))';
            return `<div class="bar-wrap" title="${labels[i]} : ${v.toLocaleString('fr-FR')} FCFA">
                <div class="bar" style="height:${h}px;background:${bg};"></div>
                <span class="bar-lbl">${labels[i]}</span>
            </div>`;
        }).join('');
    });
    </script>
</body>
</html>
