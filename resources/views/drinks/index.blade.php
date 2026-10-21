<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h2 class="m-0"><i class="bi bi-cup-straw me-2" style="color:var(--gold,#f0a500)"></i>État de la Cave</h2>
                <p class="text-muted mb-0" style="font-size:.82rem;">Gestion du stock en temps réel</p>
            </div>
            <div class="d-flex gap-2 align-items-center">
                <button class="btn-cart-toggle" onclick="toggleCart()" id="cartToggleBtn">
                    <i class="bi bi-cart3 me-1"></i>Panier
                    <span class="cart-badge" id="cartCount">0</span>
                </button>
                <a href="{{ route('drinks.create') }}" class="btn btn-nv-primary shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i>Ajouter une Boisson
                </a>
            </div>
        </div>
    </x-slot>

    <style>
        :root{--navy:#0d1b2a;--navy2:#1b2a3d;--gold:#f0a500;--gold2:#ffc642;
              --red:#e63946;--green:#2ec4b6;--light:#f0f4f9;--muted:#7a8fa6;
              --border:#e2e8f0;--radius:16px;--sh:0 4px 20px rgba(13,27,42,.10);}
        body{background:var(--light);font-family:'DM Sans',sans-serif;}
        h1,h2,h3,h4,h5,h6{font-family:'Syne',sans-serif;}

        .btn-nv-primary{background:linear-gradient(135deg,var(--gold),var(--gold2));border:none;
            color:var(--navy);font-weight:700;font-family:'Syne',sans-serif;
            border-radius:10px;padding:.55rem 1.25rem;transition:.25s;}
        .btn-nv-primary:hover{transform:translateY(-2px);box-shadow:0 6px 18px rgba(240,165,0,.35);color:var(--navy);}

        /* ── CART TOGGLE BTN ── */
        .btn-cart-toggle {
            position: relative;
            background: var(--navy); border: 2px solid var(--gold);
            color: var(--gold); font-family: 'Syne', sans-serif; font-weight: 700;
            font-size: .88rem; padding: .5rem 1.2rem; border-radius: 50px;
            cursor: pointer; transition: .25s;
        }
        .btn-cart-toggle:hover { background: var(--gold); color: var(--navy); }
        .cart-badge {
            display: inline-flex; align-items: center; justify-content: center;
            background: var(--red); color: #fff; font-size: .65rem; font-weight: 800;
            width: 18px; height: 18px; border-radius: 50%;
            position: absolute; top: -6px; right: -6px;
            transition: transform .2s;
        }
        .cart-badge.bump { transform: scale(1.4); }

        /* ── CART SIDEBAR ── */
        .cart-overlay {
            position: fixed; inset: 0; background: rgba(13,27,42,.45);
            z-index: 1040; opacity: 0; pointer-events: none;
            transition: opacity .3s;
        }
        .cart-overlay.open { opacity: 1; pointer-events: all; }

        .cart-sidebar {
            position: fixed; top: 0; right: 0; bottom: 0;
            width: 380px; max-width: 100vw;
            background: #fff; z-index: 1050;
            display: flex; flex-direction: column;
            box-shadow: -4px 0 40px rgba(13,27,42,.18);
            transform: translateX(100%);
            transition: transform .35s cubic-bezier(.4,0,.2,1);
        }
        .cart-sidebar.open { transform: translateX(0); }
        @media(max-width:420px){ .cart-sidebar { width: 100vw; } }

        .cart-head {
            background: linear-gradient(135deg,var(--navy),var(--navy2));
            color: #fff; padding: 1.1rem 1.3rem;
            display: flex; align-items: center; gap: .75rem;
            flex-shrink: 0;
        }
        .cart-head h3 { font-size: 1rem; font-weight: 800; margin: 0; flex: 1; }
        .cart-close {
            background: rgba(255,255,255,.1); border: none; color: #fff;
            width: 32px; height: 32px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 1.1rem; transition: .2s;
        }
        .cart-close:hover { background: rgba(230,57,70,.7); }

        .cart-client-wrap {
            padding: 1rem 1.3rem; border-bottom: 1px solid var(--border);
            flex-shrink: 0;
        }
        .cart-client-wrap label {
            font-size: .7rem; font-weight: 700; color: var(--muted);
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: .35rem;
            display: block;
        }
        .cart-client-input {
            width: 100%; border: 1.5px solid var(--border); border-radius: 10px;
            padding: .5rem .85rem; font-size: .9rem; font-family: 'DM Sans', sans-serif;
            transition: border-color .2s;
        }
        .cart-client-input:focus {
            outline: none; border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(240,165,0,.15);
        }

        .cart-items { flex: 1; overflow-y: auto; padding: .75rem 1.3rem; }

        .cart-item {
            display: flex; align-items: center; gap: .75rem;
            padding: .75rem; border-radius: 10px;
            border: 1px solid var(--border); margin-bottom: .6rem;
            background: #fff; transition: .2s;
        }
        .cart-item:hover { border-color: rgba(240,165,0,.4); }
        .cart-item-name { font-family: 'Syne', sans-serif; font-weight: 700;
                          font-size: .85rem; color: var(--navy); flex: 1; }
        .cart-item-price { font-size: .75rem; color: var(--muted); }
        .qty-control {
            display: flex; align-items: center; gap: .3rem;
        }
        .qty-btn {
            width: 26px; height: 26px; border-radius: 6px; border: 1.5px solid var(--border);
            background: var(--light); cursor: pointer; font-size: .85rem;
            display: flex; align-items: center; justify-content: center;
            transition: .2s; font-weight: 700; color: var(--navy);
        }
        .qty-btn:hover { background: var(--gold); border-color: var(--gold); color: var(--navy); }
        .qty-val {
            width: 32px; text-align: center; font-weight: 700;
            font-size: .88rem; color: var(--navy);
        }
        .cart-item-total {
            font-family: 'Syne', sans-serif; font-weight: 800;
            font-size: .88rem; color: var(--green); min-width: 80px; text-align: right;
        }
        .cart-item-remove {
            background: none; border: none; color: var(--muted); cursor: pointer;
            font-size: 1rem; padding: 0; transition: color .2s;
        }
        .cart-item-remove:hover { color: var(--red); }

        .cart-empty {
            text-align: center; padding: 3rem 1rem; color: var(--muted);
        }
        .cart-empty i { font-size: 2.5rem; display: block; margin-bottom: .75rem; opacity: .3; }

        .cart-footer {
            border-top: 1px solid var(--border); padding: 1rem 1.3rem;
            flex-shrink: 0;
        }
        .cart-total-row {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 1rem;
        }
        .cart-total-lbl { font-size: .75rem; font-weight: 700; color: var(--muted);
                          text-transform: uppercase; letter-spacing: 1px; }
        .cart-total-val { font-family: 'Syne', sans-serif; font-weight: 800;
                          font-size: 1.3rem; color: var(--navy); }
        .btn-checkout {
            width: 100%; background: linear-gradient(135deg,var(--green),#26a99e);
            border: none; color: #fff; font-family: 'Syne', sans-serif;
            font-weight: 800; font-size: 1rem; padding: .85rem;
            border-radius: 12px; cursor: pointer; transition: .25s;
            display: flex; align-items: center; justify-content: center; gap: .6rem;
        }
        .btn-checkout:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(46,196,182,.4); }
        .btn-checkout:disabled { opacity: .5; cursor: not-allowed; transform: none; box-shadow: none; }

        /* ── SEARCH ── */
        .search-wrap{background:#fff;border-radius:12px;box-shadow:var(--sh);
            border:1px solid var(--border);overflow:hidden;display:flex;align-items:center;}
        .search-wrap .input-group-text{background:#fff;border:none;color:var(--muted);padding:.6rem .9rem;}
        .search-wrap .form-control{border:none;padding:.6rem .3rem;font-size:.9rem;}
        .search-wrap .form-control:focus{box-shadow:none;}
        .search-wrap .btn-search{background:var(--navy);color:#fff;border:none;
            padding:.6rem 1.3rem;font-weight:600;font-size:.88rem;white-space:nowrap;}
        .search-wrap .btn-search:hover{background:var(--gold);color:var(--navy);}

        /* ── ALERTES ── */
        .alert-nv{border-left:4px solid;border-radius:10px;border-top:none;border-right:none;border-bottom:none;}
        .alert-nv-success{background:rgba(46,196,182,.08);border-color:var(--green);color:#065f52;}
        .alert-nv-error  {background:rgba(230,57,70,.08);border-color:var(--red);color:#7f1d1d;}

        /* ── CARDS ── */
        .drink-card{
            background:#fff;border-radius:var(--radius);
            box-shadow:var(--sh);overflow:hidden;
            transition:.28s;border:1px solid var(--border);
            display:flex;flex-direction:column;height:100%;
        }
        .drink-card:hover{
            transform:translateY(-4px);
            box-shadow:0 12px 36px rgba(13,27,42,.14);
            border-color:rgba(240,165,0,.35);
        }
        .drink-card.in-cart {
            border-color: var(--green) !important;
            box-shadow: 0 0 0 2px rgba(46,196,182,.25) !important;
        }
        .drink-card-img{width:100%;height:160px;object-fit:cover;background:#f1f4f9;transition:.3s;}
        .drink-card:hover .drink-card-img{transform:scale(1.04);}
        .drink-img-wrap{overflow:hidden;position:relative;flex-shrink:0;}
        .drink-img-wrap .stock-ribbon{
            position:absolute;top:10px;left:10px;
            font-size:.7rem;font-weight:700;padding:3px 10px;border-radius:20px;
        }
        .ribbon-ok   {background:rgba(5,150,105,.9); color:#fff;}
        .ribbon-low  {background:rgba(245,158,11,.9); color:#fff;}
        .ribbon-empty{background:rgba(230,57,70,.9);  color:#fff;}

        .in-cart-badge {
            position: absolute; top: 10px; right: 10px;
            background: var(--green); color: #fff;
            font-size: .68rem; font-weight: 700; padding: 3px 9px;
            border-radius: 20px;
        }

        .drink-card-body{padding:1rem 1.1rem;flex:1;display:flex;flex-direction:column;}
        .drink-name {font-family:'Syne',sans-serif;font-weight:800;font-size:1rem;
                      color:var(--navy);margin-bottom:.25rem;line-height:1.2;}
        .drink-cat  {font-size:.72rem;color:var(--muted);font-weight:600;
                      text-transform:uppercase;letter-spacing:1px;margin-bottom:.75rem;}
        .drink-prix {font-family:'Syne',sans-serif;font-weight:800;color:var(--green);font-size:1.05rem;margin-bottom:.5rem;}
        .drink-stock{font-size:.78rem;font-weight:600;color:var(--muted);}

        /* ── ADD TO CART ZONE ── */
        .add-cart-zone {
            background: #f7f9fc; border-top: 1px solid var(--border);
            padding: .75rem 1.1rem; margin-top: auto;
        }
        .add-cart-zone .zone-label {
            font-size: .68rem; font-weight: 700; color: var(--muted);
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: .4rem;
        }
        .add-cart-row { display: flex; gap: .4rem; align-items: center; }
        .add-cart-row input {
            border: 1.5px solid var(--border); border-radius: 8px;
            padding: .38rem .6rem; font-size: .82rem; background: #fff;
            width: 64px; text-align: center; transition: .2s;
        }
        .add-cart-row input:focus { border-color: var(--gold); outline: none;
            box-shadow: 0 0 0 2px rgba(240,165,0,.18); }
        .btn-add-cart {
            flex: 1; background: var(--navy); border: none; color: var(--gold);
            font-weight: 700; font-size: .8rem; padding: .4rem .85rem;
            border-radius: 8px; cursor: pointer; transition: .2s;
            display: flex; align-items: center; justify-content: center; gap: .35rem;
            white-space: nowrap;
        }
        .btn-add-cart:hover { background: var(--gold); color: var(--navy); }

        /* Vente rapide directe (si pas de panier) */
        .sell-form-card{background:#f7f9fc;border-top:1px solid var(--border);padding:.75rem 1.1rem;margin-top:auto;}
        .sell-form-card .sell-label{font-size:.7rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:.4rem;}
        .sell-row{display:flex;gap:.4rem;align-items:center;flex-wrap:wrap;}
        .sell-row input{border:1.5px solid var(--border);border-radius:8px;padding:.35rem .6rem;font-size:.82rem;background:#fff;flex:1;min-width:60px;}
        .sell-row input:focus{border-color:var(--gold);outline:none;box-shadow:0 0 0 2px rgba(240,165,0,.2);}
        .btn-sell{background:linear-gradient(135deg,var(--green),#26a99e);border:none;
            color:#fff;font-weight:700;font-size:.8rem;padding:.38rem .85rem;
            border-radius:8px;white-space:nowrap;transition:.2s;flex-shrink:0;}
        .btn-sell:hover{transform:translateY(-1px);box-shadow:0 4px 12px rgba(46,196,182,.4);}

        /* ── ACTIONS ── */
        .card-actions{display:flex;gap:.4rem;padding:.65rem 1.1rem;border-top:1px solid #f0f3f8;background:#fff;}
        .btn-edit-sm{flex:1;background:rgba(245,158,11,.1);color:#92400e;
            border:1px solid rgba(245,158,11,.25);font-size:.78rem;font-weight:600;
            border-radius:8px;padding:.35rem;text-align:center;text-decoration:none;transition:.2s;}
        .btn-edit-sm:hover{background:rgba(245,158,11,.25);color:#78350f;}
        .btn-del-sm {flex:1;background:rgba(230,57,70,.08);color:var(--red);
            border:1px solid rgba(230,57,70,.2);font-size:.78rem;font-weight:600;
            border-radius:8px;padding:.35rem;cursor:pointer;transition:.2s;}
        .btn-del-sm:hover{background:rgba(230,57,70,.18);color:#9b1c27;}

        @media(max-width:575px){ .drink-card-img{height:140px;} }
    </style>

    {{-- ════ CART OVERLAY ════ --}}
    <div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>

    {{-- ════ CART SIDEBAR ════ --}}
    <div class="cart-sidebar" id="cartSidebar">
        <div class="cart-head">
            <i class="bi bi-cart3" style="font-size:1.3rem;color:var(--gold)"></i>
            <h3>Panier de Vente</h3>
            <button class="cart-close" onclick="closeCart()"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="cart-client-wrap">
            <label for="cartClient"><i class="bi bi-person me-1"></i>Nom du Client</label>
            <input type="text" id="cartClient" class="cart-client-input"
                   placeholder="Entrez le nom du client...">
        </div>

        <div class="cart-items" id="cartItems">
            <div class="cart-empty" id="cartEmpty">
                <i class="bi bi-cart-x"></i>
                <p style="font-size:.88rem;">Le panier est vide.<br>Ajoutez des produits depuis la liste.</p>
            </div>
        </div>

        <div class="cart-footer">
            <div class="cart-total-row">
                <span class="cart-total-lbl"><i class="bi bi-calculator me-1"></i>Total</span>
                <span class="cart-total-val" id="cartTotal">0 FCFA</span>
            </div>
            <button class="btn-checkout" id="checkoutBtn" onclick="submitCart()" disabled>
                <i class="bi bi-bag-check-fill"></i>
                Confirmer la Vente
            </button>
            <form id="cartForm" action="{{ route('sales.store') }}" method="POST" style="display:none;">
                @csrf
                <input type="hidden" name="cart_data" id="cartFormData">
                <input type="hidden" name="client_name" id="cartFormClient">
            </form>
        </div>
    </div>

    <div class="py-4">
      <div class="container-fluid px-3 px-md-4" style="max-width:1400px;margin:0 auto;">

        {{-- ── BARRE RECHERCHE ── --}}
        <div class="row mb-4 align-items-center g-2">
            <div class="col-12 col-md-7 col-lg-5">
                <form action="{{ route('drinks.index') }}" method="GET">
                    <div class="search-wrap">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" name="search" class="form-control"
                               placeholder="Rechercher une boisson..."
                               value="{{ request('search') }}">
                        <button class="btn-search" type="submit">Chercher</button>
                        @if(request('search'))
                        <a href="{{ route('drinks.index') }}" class="btn btn-link text-muted px-2" title="Effacer">
                            <i class="bi bi-x-circle"></i>
                        </a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col-auto ms-md-auto d-flex align-items-center gap-3">
                <span style="font-size:.82rem;color:var(--muted);">
                    <i class="bi bi-box-seam me-1"></i>
                    <strong>{{ $drinks->count() }}</strong> produit(s)
                </span>
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

        {{-- ── INFO PANIER ── --}}
        <div class="alert alert-nv alert-nv-success mb-3" style="border-left-color:var(--gold);background:rgba(240,165,0,.07);">
            <i class="bi bi-info-circle me-2" style="color:var(--gold)"></i>
            <strong style="color:var(--navy);">Vente multiple :</strong>
            <span style="color:var(--muted);">Ajoutez plusieurs produits au panier, puis confirmez en une seule transaction.</span>
        </div>

        {{-- ── GRILLE DE CARTES ── --}}
        @if($drinks->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-inbox" style="font-size:3rem;color:#ccc;display:block;margin-bottom:1rem;"></i>
            <p class="text-muted">Aucune boisson trouvée.</p>
            <a href="{{ route('drinks.index') }}" class="btn btn-link">Voir tout le stock</a>
        </div>
        @else
        <div class="row g-3 g-md-4" id="drinksGrid">
            @foreach($drinks as $drink)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="drink-card" id="card-{{ $drink->id }}">

                    {{-- Photo --}}
                    <div class="drink-img-wrap">
                        <img src="{{ $drink->image_url }}"
                             alt="{{ $drink->nom }}"
                             class="drink-card-img"
                             loading="lazy">
                        @if($drink->quantite_stock <= 0)
                            <span class="stock-ribbon ribbon-empty"><i class="bi bi-x-circle me-1"></i>Rupture</span>
                        @elseif($drink->quantite_stock < 5)
                            <span class="stock-ribbon ribbon-low"><i class="bi bi-exclamation-triangle me-1"></i>Stock faible</span>
                        @else
                            <span class="stock-ribbon ribbon-ok"><i class="bi bi-check-circle me-1"></i>{{ $drink->quantite_stock }} unités</span>
                        @endif
                        <span class="in-cart-badge" id="inCartBadge-{{ $drink->id }}" style="display:none;">
                            <i class="bi bi-cart-check me-1"></i>Dans le panier
                        </span>
                    </div>

                    {{-- Infos --}}
                    <div class="drink-card-body">
                        <div class="drink-cat">{{ $drink->categorie }}</div>
                        <div class="drink-name">{{ $drink->nom }}</div>
                        <div class="drink-prix">{{ number_format($drink->prix_unitaire, 0, ',', ' ') }} FCFA</div>
                        <div class="drink-stock"><i class="bi bi-box me-1"></i>{{ $drink->quantite_stock }} en stock</div>
                    </div>

                    {{-- Ajouter au panier (si stock > 0) --}}
                    @if($drink->quantite_stock > 0)
                    <div class="add-cart-zone">
                        <div class="zone-label"><i class="bi bi-cart-plus me-1"></i>Ajouter au panier</div>
                        <div class="add-cart-row">
                            <input type="number"
                                   id="qty-{{ $drink->id }}"
                                   value="1" min="1" max="{{ $drink->quantite_stock }}"
                                   title="Quantité">
                            <button class="btn-add-cart"
                                    onclick="addToCart({{ $drink->id }}, '{{ addslashes($drink->nom) }}', {{ $drink->prix_unitaire }}, {{ $drink->quantite_stock }})">
                                <i class="bi bi-cart-plus"></i>Ajouter
                            </button>
                        </div>
                    </div>
                    @else
                    <div class="add-cart-zone text-center">
                        <span style="font-size:.78rem;color:var(--red);font-weight:600;">
                            <i class="bi bi-x-circle me-1"></i>Produit indisponible
                        </span>
                    </div>
                    @endif

                    {{-- Actions Modifier / Supprimer --}}
                    <div class="card-actions">
                        <a href="{{ route('drinks.edit', $drink->id) }}" class="btn-edit-sm">
                            <i class="bi bi-pencil me-1"></i>Modifier
                        </a>
                        <form action="{{ route('drinks.destroy', $drink->id) }}" method="POST"
                              style="flex:1;"
                              onsubmit="return confirm('Supprimer {{ $drink->nom }} ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-del-sm w-100">
                                <i class="bi bi-trash me-1"></i>Effacer
                            </button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
        @endif

      </div>
    </div>

    <script>
    // ════════════════════════════════════════════
    //  PANIER — logique JavaScript
    // ════════════════════════════════════════════

    let cart = {}; // { drinkId: { nom, prix, qty, maxQty } }

    function addToCart(id, nom, prix, maxQty) {
        const qtyInput = document.getElementById('qty-' + id);
        let qty = parseInt(qtyInput?.value) || 1;
        qty = Math.max(1, Math.min(qty, maxQty));

        if (cart[id]) {
            // Déjà dans le panier → on cumule (sans dépasser le stock)
            cart[id].qty = Math.min(cart[id].qty + qty, maxQty);
        } else {
            cart[id] = { nom, prix, qty, maxQty };
        }

        renderCart();
        openCart();

        // Feedback visuel sur la carte
        const card = document.getElementById('card-' + id);
        if (card) card.classList.add('in-cart');
        const badge = document.getElementById('inCartBadge-' + id);
        if (badge) badge.style.display = 'inline-flex';

        // Bump badge
        const countEl = document.getElementById('cartCount');
        countEl.classList.add('bump');
        setTimeout(() => countEl.classList.remove('bump'), 200);
    }

    function removeFromCart(id) {
        delete cart[id];
        const card = document.getElementById('card-' + id);
        if (card) card.classList.remove('in-cart');
        const badge = document.getElementById('inCartBadge-' + id);
        if (badge) badge.style.display = 'none';
        renderCart();
    }

    function changeQty(id, delta) {
        if (!cart[id]) return;
        cart[id].qty = Math.max(1, Math.min(cart[id].qty + delta, cart[id].maxQty));
        renderCart();
    }

    function renderCart() {
        const container = document.getElementById('cartItems');
        const emptyEl   = document.getElementById('cartEmpty');
        const totalEl   = document.getElementById('cartTotal');
        const countEl   = document.getElementById('cartCount');
        const checkBtn  = document.getElementById('checkoutBtn');

        const ids = Object.keys(cart);

        countEl.textContent = ids.reduce((sum, k) => sum + cart[k].qty, 0);
        countEl.style.display = ids.length ? 'flex' : 'flex';

        if (ids.length === 0) {
            container.innerHTML = '';
            container.appendChild(emptyEl);
            emptyEl.style.display = 'block';
            totalEl.textContent = '0 FCFA';
            checkBtn.disabled = true;
            return;
        }

        emptyEl.style.display = 'none';

        let html = '';
        let total = 0;

        ids.forEach(id => {
            const item = cart[id];
            const subtotal = item.prix * item.qty;
            total += subtotal;
            html += `
            <div class="cart-item" id="cartItem-${id}">
                <div style="flex:1;">
                    <div class="cart-item-name">${item.nom}</div>
                    <div class="cart-item-price">${item.prix.toLocaleString('fr-FR')} FCFA / unité</div>
                </div>
                <div class="qty-control">
                    <button class="qty-btn" onclick="changeQty(${id}, -1)">−</button>
                    <span class="qty-val">${item.qty}</span>
                    <button class="qty-btn" onclick="changeQty(${id}, +1)">+</button>
                </div>
                <div class="cart-item-total">${subtotal.toLocaleString('fr-FR')} F</div>
                <button class="cart-item-remove" onclick="removeFromCart(${id})" title="Retirer">
                    <i class="bi bi-x-circle-fill"></i>
                </button>
            </div>`;
        });

        container.innerHTML = html;
        totalEl.textContent = total.toLocaleString('fr-FR') + ' FCFA';
        checkBtn.disabled = false;
    }

    function submitCart() {
        const client = document.getElementById('cartClient').value.trim();
        const ids = Object.keys(cart);
        if (!ids.length) return;

        // Construire les données
        const cartData = ids.map(id => ({
            drink_id: id,
            quantite_vendue: cart[id].qty
        }));

        document.getElementById('cartFormData').value   = JSON.stringify(cartData);
        document.getElementById('cartFormClient').value = client;
        document.getElementById('cartForm').submit();
    }

    function openCart()  {
        document.getElementById('cartSidebar').classList.add('open');
        document.getElementById('cartOverlay').classList.add('open');
    }
    function closeCart() {
        document.getElementById('cartSidebar').classList.remove('open');
        document.getElementById('cartOverlay').classList.remove('open');
    }
    function toggleCart() {
        const s = document.getElementById('cartSidebar');
        s.classList.contains('open') ? closeCart() : openCart();
    }

    // Init
    renderCart();
    </script>
</x-app-layout>
