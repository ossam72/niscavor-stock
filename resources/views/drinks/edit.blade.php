<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('drinks.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="m-0"><i class="bi bi-pencil-square me-2" style="color:var(--gold,#f0a500)"></i>Modifier la Boisson</h2>
                <p class="text-muted mb-0" style="font-size:.82rem;">{{ $drink->nom }}</p>
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
            color:var(--navy);text-decoration:none;transition:.2s;flex-shrink:0;}
        .btn-back:hover{background:var(--navy);color:#fff;}

        .form-card{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;}
        .form-card-header{background:linear-gradient(135deg,var(--navy),var(--navy2));
            padding:1.4rem 2rem;display:flex;align-items:center;gap:1rem;}
        .form-card-header img{width:56px;height:56px;border-radius:12px;
            object-fit:cover;border:2px solid var(--gold);flex-shrink:0;}
        .form-card-header .title{color:#fff;font-family:'Syne',sans-serif;font-weight:800;font-size:1.1rem;margin:0;}
        .form-card-header .sub{color:rgba(255,255,255,.55);font-size:.78rem;margin:.2rem 0 0;}

        .field-label{font-family:'Syne',sans-serif;font-weight:700;font-size:.78rem;
            color:var(--navy);text-transform:uppercase;letter-spacing:1px;
            display:flex;align-items:center;gap:.4rem;margin-bottom:.5rem;}
        .field-label i{color:var(--gold);}
        .field-input{border:1.5px solid #dde3ec;border-radius:10px;padding:.65rem .9rem;
            font-size:.9rem;transition:.25s;width:100%;background:#fafbfd;}
        .field-input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(240,165,0,.15);
            background:#fff;outline:none;}

        /* ── IMAGE ACTUELLE ── */
        .current-img-box{
            background:#f7f8fc;border:1.5px solid #e8edf3;border-radius:14px;
            padding:1rem;display:flex;align-items:center;gap:1rem;margin-bottom:1rem;
        }
        .current-img-box img{width:72px;height:72px;object-fit:cover;
            border-radius:10px;border:2px solid rgba(240,165,0,.3);flex-shrink:0;}
        .current-img-box .ci-info .ci-label{font-size:.7rem;color:var(--muted);
            font-weight:700;text-transform:uppercase;letter-spacing:1px;}
        .current-img-box .ci-info .ci-name{font-family:'Syne',sans-serif;
            font-weight:700;color:var(--navy);font-size:.9rem;}

        /* ── UPLOAD ZONE ── */
        .upload-zone{border:2.5px dashed #dde3ec;border-radius:14px;
            padding:1.5rem 1rem;text-align:center;cursor:pointer;transition:.25s;
            background:#fafbfd;position:relative;}
        .upload-zone:hover,.upload-zone.dragover{border-color:var(--gold);background:rgba(240,165,0,.05);}
        .upload-zone input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%;}
        .upload-icon{font-size:2rem;display:block;margin-bottom:.4rem;color:var(--muted);}
        .upload-txt{font-weight:700;color:var(--navy);font-size:.88rem;}
        .upload-sub{font-size:.73rem;color:var(--muted);margin-top:.2rem;}

        .img-preview-wrap{display:none;position:relative;margin-top:.75rem;}
        .img-preview-wrap.show{display:block;}
        .img-preview-wrap img{width:100%;max-height:180px;object-fit:contain;
            border-radius:12px;border:2px solid rgba(240,165,0,.3);background:#f1f4f9;}
        .img-preview-remove{position:absolute;top:8px;right:8px;background:var(--red);
            color:#fff;border:none;width:28px;height:28px;border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            cursor:pointer;font-size:.85rem;transition:.2s;}
        .img-preview-remove:hover{transform:scale(1.1);}

        /* ── REMOVE CHECKBOX ── */
        .remove-check{display:flex;align-items:center;gap:.5rem;padding:.6rem .8rem;
            background:rgba(230,57,70,.06);border:1px solid rgba(230,57,70,.2);
            border-radius:10px;cursor:pointer;margin-top:.5rem;}
        .remove-check input{accent-color:var(--red);cursor:pointer;}
        .remove-check span{font-size:.8rem;color:var(--red);font-weight:600;}

        /* ── CAT GRID ── */
        .cat-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:.65rem;}
        .cat-option{display:none;}
        .cat-label{display:flex;align-items:center;gap:.6rem;padding:.65rem .9rem;
            border:2px solid #e8edf3;border-radius:12px;cursor:pointer;transition:.2s;background:#fafbfd;}
        .cat-label .cat-icon{font-size:1.4rem;}
        .cat-label .cat-text{font-family:'Syne',sans-serif;font-size:.82rem;font-weight:700;color:var(--navy);}
        .cat-option:checked + .cat-label{border-color:var(--gold);background:rgba(240,165,0,.08);}
        .cat-option:checked + .cat-label .cat-text{color:var(--gold);}

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
            .current-img-box{flex-direction:column;text-align:center;}
        }
    </style>

    <div class="py-4">
      <div class="container-fluid px-3 px-md-4">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-8 col-xl-6">
            <div class="form-card">

              {{-- Header avec photo actuelle --}}
              <div class="form-card-header">
                <img src="{{ $drink->image_url }}" alt="{{ $drink->nom }}">
                <div>
                    <p class="title">✏️ {{ $drink->nom }}</p>
                    <p class="sub">Modifiez les informations ci-dessous</p>
                </div>
              </div>

              <form action="{{ route('drinks.update', $drink->id) }}" method="POST"
                    enctype="multipart/form-data" id="drinkForm">
                @csrf
                @method('PUT')
                <div class="p-4">

                  {{-- ── PHOTO ── --}}
                  <div class="mb-4">
                    <label class="field-label"><i class="bi bi-image-fill"></i>Photo du produit</label>

                    {{-- Image actuelle --}}
                    @if($drink->image)
                    <div class="current-img-box">
                        <img src="{{ $drink->image_url }}" alt="{{ $drink->nom }}">
                        <div class="ci-info">
                            <div class="ci-label">Photo actuelle</div>
                            <div class="ci-name">{{ $drink->nom }}</div>
                        </div>
                    </div>
                    <label class="remove-check">
                        <input type="checkbox" name="remove_image" value="1" id="removeCheck">
                        <span><i class="bi bi-trash me-1"></i>Supprimer la photo actuelle</span>
                    </label>
                    @endif

                    {{-- Zone upload --}}
                    <div class="upload-zone mt-2" id="uploadZone">
                        <input type="file" name="image" id="imageInput" accept="image/*">
                        <span class="upload-icon">📸</span>
                        <div class="upload-txt">{{ $drink->image ? 'Remplacer la photo' : 'Ajouter une photo' }}</div>
                        <div class="upload-sub">JPEG, PNG, WEBP — max 2 Mo</div>
                    </div>
                    <div class="img-preview-wrap" id="previewWrap">
                        <img id="previewImg" src="" alt="Aperçu">
                        <button type="button" class="img-preview-remove" id="removeImgBtn">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    @error('image')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                  </div>

                  {{-- ── NOM ── --}}
                  <div class="mb-3">
                    <label class="field-label"><i class="bi bi-tag-fill"></i>Nom de la boisson</label>
                    <input type="text" name="nom" class="field-input"
                           value="{{ old('nom', $drink->nom) }}" required>
                    @error('nom')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                  </div>

                  {{-- ── CATÉGORIE ── --}}
                  <div class="mb-3">
                    <label class="field-label"><i class="bi bi-grid-3x3-gap-fill"></i>Catégorie</label>
                    <div class="cat-grid">
                        @php $cats=[
                            ['value'=>'Bière','icon'=>'🍺'],
                            ['value'=>'Vin',  'icon'=>'🍷'],
                            ['value'=>'Jus',  'icon'=>'🥤'],
                            ['value'=>'Eau',  'icon'=>'💧'],
                        ]; @endphp
                        @foreach($cats as $i => $cat)
                        <div>
                            <input type="radio" name="categorie" id="cat_{{ $i }}"
                                   class="cat-option" value="{{ $cat['value'] }}"
                                   {{ old('categorie', $drink->categorie) === $cat['value'] ? 'checked':'' }}>
                            <label class="cat-label" for="cat_{{ $i }}">
                                <span class="cat-icon">{{ $cat['icon'] }}</span>
                                <div class="cat-text">{{ $cat['value'] }}</div>
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
                        <input type="number" name="quantite_stock" class="field-input"
                               value="{{ old('quantite_stock', $drink->quantite_stock) }}" min="0" required>
                        @error('quantite_stock')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>
                    <div class="col-6">
                        <label class="field-label"><i class="bi bi-currency-dollar"></i>Prix (FCFA)</label>
                        <input type="number" name="prix_unitaire" class="field-input"
                               value="{{ old('prix_unitaire', $drink->prix_unitaire) }}" min="0" required>
                        @error('prix_unitaire')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>
                  </div>
                </div>

                <div class="submit-area">
                  <div class="d-flex gap-3 flex-column flex-sm-row">
                    <a href="{{ route('drinks.index') }}" class="btn-cancel order-2 order-sm-1">
                        <i class="bi bi-x me-1"></i>Annuler
                    </a>
                    <button type="submit" class="btn-submit order-1 order-sm-2">
                        <i class="bi bi-check-circle-fill me-2"></i>Enregistrer les modifications
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
    const input     = document.getElementById('imageInput');
    const zone      = document.getElementById('uploadZone');
    const wrap      = document.getElementById('previewWrap');
    const img       = document.getElementById('previewImg');
    const removeBtn = document.getElementById('removeImgBtn');

    if (input) {
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

        if (removeBtn) {
            removeBtn.addEventListener('click', () => {
                input.value = '';
                img.src = '';
                wrap.classList.remove('show');
                zone.style.display = 'block';
            });
        }

        zone.addEventListener('dragover',  e => { e.preventDefault(); zone.classList.add('dragover'); });
        zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
        zone.addEventListener('drop', e => {
            e.preventDefault(); zone.classList.remove('dragover');
            if (e.dataTransfer.files[0]) {
                input.files = e.dataTransfer.files;
                input.dispatchEvent(new Event('change'));
            }
        });
    }
    </script>
</x-app-layout>
