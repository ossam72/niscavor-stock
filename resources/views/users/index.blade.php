<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h2 class="m-0"><i class="bi bi-people-fill me-2" style="color:var(--gold,#f0a500)"></i>Gestion des Utilisateurs</h2>
                <p class="text-muted mb-0" style="font-size:.82rem;">Clients et Administrateurs</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-nv-primary">
                <i class="bi bi-person-plus-fill me-1"></i>Ajouter un utilisateur
            </a>
        </div>
    </x-slot>

    <style>
        :root{--navy:#0d1b2a;--navy2:#1b2a3d;--gold:#f0a500;--gold2:#ffc642;
              --red:#e63946;--green:#2ec4b6;--light:#f7f8fc;--muted:#8494a7;
              --radius:16px;--shadow:0 4px 24px rgba(13,27,42,.10);}
        body{background:var(--light);font-family:'DM Sans',sans-serif;}
        h1,h2,h3,h4,h5,h6{font-family:'Syne',sans-serif;}

        .btn-nv-primary{background:linear-gradient(135deg,var(--gold),var(--gold2));border:none;
            color:var(--navy);font-weight:700;font-family:'Syne',sans-serif;
            border-radius:10px;padding:.55rem 1.25rem;transition:.25s;}
        .btn-nv-primary:hover{transform:translateY(-2px);box-shadow:0 6px 18px rgba(240,165,0,.35);color:var(--navy);}

        /* ── STAT MINI CARDS ── */
        .mini-stat{background:#fff;border-radius:14px;box-shadow:var(--shadow);
            padding:1.1rem 1.3rem;display:flex;align-items:center;gap:1rem;}
        .mini-stat .ms-icon{width:48px;height:48px;border-radius:12px;
            display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0;}
        .ms-admin{background:linear-gradient(135deg,var(--navy),var(--navy2));}
        .ms-client{background:linear-gradient(135deg,#0369a1,#0284c7);}
        .mini-stat .ms-val{font-family:'Syne',sans-serif;font-weight:800;font-size:1.5rem;color:var(--navy);line-height:1;}
        .mini-stat .ms-lbl{font-size:.72rem;color:var(--muted);text-transform:uppercase;letter-spacing:1px;font-weight:700;}

        /* ── SEARCH & FILTER ── */
        .search-wrap{background:#fff;border-radius:12px;box-shadow:var(--shadow);
            border:1px solid #e8edf3;overflow:hidden;display:flex;align-items:center;}
        .search-wrap .input-group-text{background:#fff;border:none;color:var(--muted);padding:.6rem .9rem;}
        .search-wrap .form-control{border:none;padding:.6rem .3rem;font-size:.9rem;}
        .search-wrap .form-control:focus{box-shadow:none;}
        .search-wrap .btn-search{background:var(--navy);color:#fff;border:none;
            padding:.6rem 1.3rem;font-weight:600;font-size:.88rem;}
        .search-wrap .btn-search:hover{background:var(--gold);color:var(--navy);}

        .filter-btn{background:#fff;border:1.5px solid #dde3ec;color:var(--muted);
            border-radius:10px;padding:.45rem 1rem;font-size:.85rem;font-weight:600;
            transition:.2s;text-decoration:none;}
        .filter-btn:hover,.filter-btn.active{background:var(--navy);border-color:var(--navy);color:#fff;}
        .filter-btn.active-admin{background:var(--navy);border-color:var(--navy);color:#fff;}
        .filter-btn.active-client{background:#0369a1;border-color:#0369a1;color:#fff;}

        /* ── TABLE ── */
        .table-card{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;}
        .table-header{background:linear-gradient(135deg,var(--navy),var(--navy2));
            padding:.9rem 1.4rem;display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;}
        .table-header span{color:#fff;font-family:'Syne',sans-serif;font-weight:700;}
        .table-header .bge{background:var(--gold);color:var(--navy);font-size:.68rem;
            padding:3px 10px;border-radius:20px;font-weight:800;margin-left:auto;}

        .tbl-users thead th{background:#f1f4f9;color:var(--navy);font-family:'Syne',sans-serif;
            font-size:.72rem;text-transform:uppercase;letter-spacing:1.2px;
            border:none;padding:.85rem 1rem;font-weight:700;}
        .tbl-users tbody tr{border-bottom:1px solid #f0f3f8;transition:.15s;}
        .tbl-users tbody tr:hover{background:rgba(240,165,0,.04);}
        .tbl-users td{border:none;padding:.8rem 1rem;vertical-align:middle;}

        /* ── BADGES ROLE ── */
        .badge-admin{background:linear-gradient(135deg,var(--navy),var(--navy2));
            color:#fff;font-size:.72rem;padding:5px 13px;border-radius:20px;font-weight:700;}
        .badge-client{background:linear-gradient(135deg,#0369a1,#0284c7);
            color:#fff;font-size:.72rem;padding:5px 13px;border-radius:20px;font-weight:700;}

        /* ── AVATAR ── */
        .user-avatar{width:38px;height:38px;border-radius:50%;
            background:linear-gradient(135deg,var(--gold),var(--gold2));
            display:flex;align-items:center;justify-content:center;
            font-family:'Syne',sans-serif;font-weight:800;font-size:.95rem;
            color:var(--navy);flex-shrink:0;}
        .user-avatar.av-client{background:linear-gradient(135deg,#0369a1,#0284c7);color:#fff;}

        /* ── ACTION BTNS ── */
        .btn-edit-sm{background:rgba(245,158,11,.1);color:#92400e;border:1px solid rgba(245,158,11,.25);
            font-size:.78rem;font-weight:600;border-radius:8px;padding:.3rem .75rem;transition:.2s;text-decoration:none;}
        .btn-edit-sm:hover{background:rgba(245,158,11,.25);color:#78350f;}
        .btn-del-sm{background:rgba(230,57,70,.08);color:var(--red);border:1px solid rgba(230,57,70,.2);
            font-size:.78rem;font-weight:600;border-radius:8px;padding:.3rem .75rem;cursor:pointer;transition:.2s;}
        .btn-del-sm:hover{background:rgba(230,57,70,.18);}

        /* ── ALERTS ── */
        .alert-nv{border-left:4px solid;border-radius:10px;border-top:none;border-right:none;border-bottom:none;}
        .alert-nv-success{background:rgba(46,196,182,.1);border-color:var(--green);color:#065f52;}
        .alert-nv-error  {background:rgba(230,57,70,.08);border-color:var(--red);color:#7f1d1d;}

        /* ── MOBILE ── */
        @media(max-width:767px){
            .tbl-users thead{display:none;}
            .tbl-users tbody tr{display:block;margin:.5rem;border-radius:14px;
                border:1px solid #e8edf3;box-shadow:0 2px 12px rgba(0,0,0,.07);background:#fff;}
            .tbl-users td{display:flex;justify-content:space-between;align-items:center;
                padding:.6rem .9rem;border-bottom:1px solid #f5f5f5;}
            .tbl-users td:last-child{border-bottom:none;}
            .tbl-users td::before{content:attr(data-label);font-size:.7rem;font-weight:700;
                color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin-right:.5rem;}
        }
    </style>

    <div class="py-4">
      <div class="container-fluid px-3 px-md-4" style="max-width:1400px;margin:0 auto;">

        {{-- ── MINI STATS ── --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="mini-stat">
                    <div class="ms-icon ms-admin">👑</div>
                    <div>
                        <div class="ms-val">{{ $nbAdmins }}</div>
                        <div class="ms-lbl">Admins</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat">
                    <div class="ms-icon ms-client">👤</div>
                    <div>
                        <div class="ms-val">{{ $nbClients }}</div>
                        <div class="ms-lbl">Clients</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── ALERTES ── --}}
        @if(session('success'))
        <div class="alert alert-nv alert-nv-success alert-dismissible fade show mb-3">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-nv alert-nv-error alert-dismissible fade show mb-3">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- ── SEARCH + FILTRES ── --}}
        <div class="d-flex flex-wrap gap-2 mb-4 align-items-center">
            <div style="flex:1;min-width:220px;max-width:400px;">
                <form action="{{ route('users.index') }}" method="GET">
                    <input type="hidden" name="role" value="{{ request('role') }}">
                    <div class="search-wrap">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control"
                               placeholder="Nom, email..." value="{{ request('search') }}">
                        <button class="btn-search" type="submit">Chercher</button>
                    </div>
                </form>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('users.index') }}"
                   class="filter-btn {{ !request('role') ? 'active' : '' }}">
                    <i class="bi bi-people me-1"></i>Tous
                </a>
                <a href="{{ route('users.index', ['role'=>'admin']) }}"
                   class="filter-btn {{ request('role')==='admin' ? 'active-admin active' : '' }}">
                    <i class="bi bi-shield-fill me-1"></i>Admins
                </a>
                <a href="{{ route('users.index', ['role'=>'client']) }}"
                   class="filter-btn {{ request('role')==='client' ? 'active-client active' : '' }}">
                    <i class="bi bi-person me-1"></i>Clients
                </a>
            </div>
        </div>

        {{-- ── TABLEAU ── --}}
        <div class="table-card">
            <div class="table-header">
                <i class="bi bi-table" style="color:var(--gold)"></i>
                <span>Liste des utilisateurs</span>
                <span class="bge">{{ $users->count() }} utilisateurs</span>
            </div>
            <div class="table-responsive">
                <table class="table tbl-users mb-0">
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Téléphone</th>
                            <th>Inscrit le</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td data-label="Nom">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="user-avatar {{ $user->isClient() ? 'av-client' : '' }}">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span style="font-family:'Syne',sans-serif;font-weight:700;color:var(--navy);">
                                        {{ $user->name }}
                                        @if($user->id === auth()->id())
                                            <span style="font-size:.65rem;color:var(--gold);"> (vous)</span>
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td data-label="Email" style="color:var(--muted);font-size:.88rem;">
                                {{ $user->email }}
                            </td>
                            <td data-label="Rôle">
                                @if($user->isAdmin())
                                    <span class="badge-admin"><i class="bi bi-shield-fill me-1"></i>Admin</span>
                                @else
                                    <span class="badge-client"><i class="bi bi-person me-1"></i>Client</span>
                                @endif
                            </td>
                            <td data-label="Téléphone" style="color:var(--muted);font-size:.88rem;">
                                {{ $user->telephone ?? '—' }}
                            </td>
                            <td data-label="Inscrit le" style="font-size:.82rem;color:var(--muted);">
                                {{ $user->created_at->format('d/m/Y') }}
                            </td>
                            <td data-label="Actions" class="text-end">
                                <div class="d-flex gap-1 justify-content-end">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn-edit-sm">
                                        <i class="bi bi-pencil me-1"></i>Modifier
                                    </a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                          onsubmit="return confirm('Supprimer {{ $user->name }} ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-del-sm">
                                            <i class="bi bi-trash me-1"></i>Effacer
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox" style="font-size:2.5rem;display:block;margin-bottom:.75rem;color:#ccc;"></i>
                                Aucun utilisateur trouvé.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

      </div>
    </div>
</x-app-layout>
