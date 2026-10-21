<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('drinks.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="m-0"><i class="bi bi-plus-circle me-2" style="color:var(--gold,#f0a500)"></i>Ajouter une Boisson</h2>
                <p class="text-muted mb-0" style="font-size:.82rem;">Enregistrement d'un nouveau produit en cave</p>
            </div>
        </div>
    </x-slot>

    <style>
        :root{--navy:#0d1b2a;--navy2:#1b2a3d;--gold:#f0a500;--gold2:#ffc642;
              --red:#e63946;--green:#2ec4b6;--light:#f7f8fc;--muted:#8494a7;
              --radius:16px;--shadow:0 4px 24px rgba(13,27,42,.10);}
        body{background:var(--light);font-family:'DM Sans',sans-serif;}
        h1,h2,h3,h4,h5,h6{font-family:'Syne',sans-serif;}

        .btn-back{width:36px;height:36px;background:#fff;border:1px solid #e8edf3;
            border-radius:10px;display:flex;align-items:center;justify-content:center;
            color:var(--navy);text-decoration:none;transition:.2s;flex-shrink:0;
            box-shadow:0 2px 8px rgba(0,0,0,.06);}
        .btn-back:hover{background:var(--navy);color:#fff;}

        .form-card{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;}
        .form-card-header{background:linear-gradient(135deg,var(--navy),var(--navy2));
            padding:1.4rem 2rem;text-align:center;}
        .form-card-header h4{font-family:'Syne',sans-serif;font-weight:800;color:#fff;margin:0;font-size:1.3rem;}
        .form-card-header p{color:rgba(255,255,255,.55);font-size:.8rem;margin:.3rem 0 0;}

        .field-label{font-family:'Syne',sans-serif;font-weight:700;font-size:.78rem;
            color:var(--navy);text-transform:uppercase;letter-spacing:1px;
            display:flex;align-items:center;gap:.4rem;margin-bottom:.5rem;}
        .field-label i{color:var(--gold);}
        .field-input{border:1.5px solid #dde3ec;border-radius:10px;padding:.65rem .9rem;
            font-size:.9rem;transition:.25s;width:100%;background:#fafbfd;}
        .field-input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(240,165,0,.15);
            background:#fff;outline:none;}

        /* ── UPLOAD ZONE ── */
        .upload-zone{
            border:2.5px dashed #dde3ec;border-radius:14px;
            padding:2rem 1rem;text-align:center;cursor:pointer;
            transition:.25s;background:#fafbfd;position:relative;
        }
        .upload-zone:hover,.upload-zone.dragover{
            border-color:var(--gold);background:rgba(240,165,0,.05);
        }
        .upload-zone input[type=file]{
            position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;
        }
        .upload-icon{font-size:2.5rem;display:block;margin-bottom:.5rem;color:var(--muted);}
        .upload-txt{font-weight:700;color:var(--navy);font-size:.9rem;}
        .upload-sub{font-size:.75rem;color:var(--muted);margin-top:.2rem;}

        /* ── PREVIEW ── */
        .img-preview-wrap{display:none;position:relative;margin-top:1rem;}
        .img-preview-wrap.show{display:block;}
        .img-preview-wrap img{
            width:100%;max-height:200px;object-fit:contain;
            border-radius:12px;border:2px solid rgba(240,165,0,.3);
            background:#f1f4f9;
        }
        .img-preview-remove{
            position:absolute;top:8px;right:8px;
            background:var(--red);color:#fff;border:none;
            width:28px;height:28px;border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;font-size:.85rem;transition:.2s;
        }
        .img-preview-remove:hover{transform:scale(1.1);}

        /* ── CAT GRID ── */
        .cat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.65rem;}
        .cat-option{display:none;}
        .cat-label{display:flex;align-items:center;gap:.6rem;padding:.65rem .9rem;
            border:2px solid #e8edf3;border-radius:12px;cursor:pointer;transition:.2s;background:#fafbfd;}
        .cat-label .cat-icon{font-size:1.4rem;}
        .cat-label .cat-text{font-family:'Syne',sans-serif;font-size:.82rem;font-weight:700;color:var(--navy);}
        .cat-option:checked + .cat-label{border-color:var(--gold);background:rgba(240,165,0,.08);}
        .cat-option:checked + .cat-label .cat-text{color:var(--gold);}

        /* ── PRICE PREVIEW ── */
        .price-preview{background:rgba(46,196,182,.08);border:1px solid rgba(46,196,182,.25);
            border-radius:12px;padding:.9rem 1.1rem;margin-top:.5rem;display:none;}
        .price-preview.show{display:block;}
        .price-preview .pp-label{font-size:.7rem;color:var(--green);font-weight:700;
            text-transform:uppercase;letter-spacing:1px;}
        .price-preview .pp-val{font-family:'Syne',sans-serif;font-weight:800;
            color:var(--navy);font-size:1.1rem;margin-top:.2rem;}

        .submit-area{background:#f7f8fc;border-top:1px solid #eef1f6;padding:1.5rem 2rem;}
        .btn-submit{background:linear-gradient(135deg,var(--gold),var(--gold2));border:none;
            color:var(--navy);font-family:'Syne',sans-serif;font-weight:800;font-size:1rem;
            padding:.75rem 2rem;border-radius:12px;transition:.25s;width:100%;}
        .btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(240,165,0,.4);color:var(--navy);}
        .btn-cancel{background:transparent;border:1.5px solid #dde3ec;color:var(--muted);
            font-weight:600;border-radius:12px;padding:.75rem 1.5rem;transition:.2s;width:100%;
            text-decoration:none;display:flex;align-items:center;justify-content:center;font-size:.9rem;}
        .btn-cancel:hover{border-color:var(--red);color:var(--red);}

        .err-msg{color:var(--red);font-size:.78rem;margin-top:.3rem;display:flex;align-items:center;gap:.3rem;}

        @media(max-width:575px){
            .cat-grid{grid-template-columns:1fr 1fr;}
            .form-card-header,.submit-area{padding:1.2rem;}
            .form-card .p-4{padding:1.2rem!important;}
        }
    </style>

    <div class="py-4">
      <div class="container-fluid px-3 px-md-4">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-8 col-xl-6">
            <div class="form-card">

              <div class="form-card-header">
                <h4>🍷 Nouvelle Boisson</h4>
                <p>Remplissez les informations ci-dessous</p>
              </div>

              {{-- IMPORTANT : enctype pour l'upload --}}
              <form action="{{ route('drinks.store') }}" method="POST" enctype="multipart/form-data" id="drinkForm">
                @csrf
                <div class="p-4">

                  {{-- ── PHOTO ── --}}
                  <div class="mb-4">
                    <label class="field-label"><i class="bi bi-image-fill"></i>Photo du produit</label>
                    <div class="upload-zone" id="uploadZone">
                        <input type="file" name="image" id="imageInput" accept="image/*">
                        <span class="upload-icon">📸</span>
                        <div class="upload-txt">Cliquer ou glisser une photo ici</div>
                        <div class="upload-sub">JPEG, PNG, WEBP — max 2 Mo</div>
                    </div>
                    <div class="img-preview-wrap" id="previewWrap">
                        <img id="previewImg" src="" alt="Aperçu">
                        <button type="button" class="img-preview-remove" id="removeImg">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    @error('image')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                  </div>

                  {{-- ── NOM ── --}}
                  <div class="mb-3">
                    <label class="field-label"><i class="bi bi-tag-fill"></i>Nom de la boisson</label>
                    <input type="text" name="nom" class="field-input"
                           placeholder="Ex: Castel, Coca-Cola, Vin Rouge..."
                           value="{{ old('nom') }}" required>
                    @error('nom')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                  </div>

                  {{-- ── CATÉGORIE ── --}}
                  <div class="mb-3">
                    <label class="field-label"><i class="bi bi-grid-3x3-gap-fill"></i>Catégorie</label>
                    <div class="cat-grid">
                        @php $cats=[
                            ['value'=>'Bière','icon'=>'🍺','sub'=>'Blonde, brune...'],
                            ['value'=>'Vin',  'icon'=>'🍷','sub'=>'Rouge, blanc, rosé...'],
                            ['value'=>'Jus',  'icon'=>'🥤','sub'=>'Jus & sodas...'],
                            ['value'=>'Eau',  'icon'=>'💧','sub'=>'Eau minérale...'],
                        ]; @endphp
                        @foreach($cats as $i => $cat)
                        <div>
                            <input type="radio" name="categorie" id="cat_{{ $i }}"
                                   class="cat-option" value="{{ $cat['value'] }}"
                                   {{ old('categorie',$loop->first?$cat['value']:'') === $cat['value'] ? 'checked':'' }}>
                            <label class="cat-label" for="cat_{{ $i }}">
                                <span class="cat-icon">{{ $cat['icon'] }}</span>
                                <div>
                                    <div class="cat-text">{{ $cat['value'] }}</div>
                                    <div style="font-size:.68rem;color:var(--muted);">{{ $cat['sub'] }}</div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @error('categorie')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                  </div>

                  {{-- ── QTÉ + PRIX ── --}}
                  <div class="row g-3">
                    <div class="col-6">
                        <label class="field-label"><i class="bi bi-boxes"></i>Quantité</label>
                        <input type="number" name="quantite_stock" id="qtyInput"
                               class="field-input" placeholder="0"
                               value="{{ old('quantite_stock') }}" min="0" required>
                        @error('quantite_stock')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>
                    <div class="col-6">
                        <label class="field-label"><i class="bi bi-currency-dollar"></i>Prix (FCFA)</label>
                        <input type="number" name="prix_unitaire" id="prixInput"
                               class="field-input" placeholder="500"
                               value="{{ old('prix_unitaire') }}" min="0" required>
                        @error('prix_unitaire')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>
                  </div>

                  {{-- Valeur stock preview --}}
                  <div class="price-preview mt-3" id="stockPreview">
                    <div class="pp-label"><i class="bi bi-calculator me-1"></i>Valeur totale du stock</div>
                    <div class="pp-val" id="stockVal">—</div>
                  </div>

                </div>

                <div class="submit-area">
                  <div class="d-flex gap-3 flex-column flex-sm-row">
                    <a href="{{ route('drinks.index') }}" class="btn-cancel order-2 order-sm-1">
                        <i class="bi bi-x me-1"></i>Annuler
                    </a>
                    <button type="submit" class="btn-submit order-1 order-sm-2">
                        <i class="bi bi-cloud-check-fill me-2"></i>Enregistrer en Cave
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
    // ── UPLOAD PREVIEW (Pattern Observer) ──
    const input    = document.getElementById('imageInput');
    const zone     = document.getElementById('uploadZone');
    const wrap     = document.getElementById('previewWrap');
    const img      = document.getElementById('previewImg');
    const removeBtn = document.getElementById('removeImg');

    input.addEventListener('change', () => {
        const file = input.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            wrap.classList.add('show');
            zone.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    removeBtn.addEventListener('click', () => {
        input.value = '';
        img.src = '';
        wrap.classList.remove('show');
        zone.style.display = 'block';
    });

    // Drag & drop
    zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('dragover'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
    zone.addEventListener('drop', e => {
        e.preventDefault(); zone.classList.remove('dragover');
        if (e.dataTransfer.files[0]) {
            input.files = e.dataTransfer.files;
            input.dispatchEvent(new Event('change'));
        }
    });

    // ── PRICE PREVIEW (Pattern Observer) ──
    const qtyInput  = document.getElementById('qtyInput');
    const prixInput = document.getElementById('prixInput');
    const preview   = document.getElementById('stockPreview');
    const valEl     = document.getElementById('stockVal');

    function updatePreview() {
        const q = parseFloat(qtyInput.value)  || 0;
        const p = parseFloat(prixInput.value) || 0;
        if (q > 0 && p > 0) {
            preview.classList.add('show');
            valEl.textContent = (q * p).toLocaleString('fr-FR') + ' FCFA';
        } else {
            preview.classList.remove('show');
        }
    }
    qtyInput.addEventListener('input', updatePreview);
    prixInput.addEventListener('input', updatePreview);
    </script>
</x-app-layout>
