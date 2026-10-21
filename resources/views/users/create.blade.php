{{-- ============================================================
     Ce fichier sert pour CREATE et EDIT
     Utilisation : @include ou copier-coller pour les deux vues
     ============================================================ --}}
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('users.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="m-0">
                    @isset($user)
                        <i class="bi bi-person-gear me-2" style="color:var(--gold,#f0a500)"></i>Modifier l'utilisateur
                    @else
                        <i class="bi bi-person-plus-fill me-2" style="color:var(--gold,#f0a500)"></i>Ajouter un utilisateur
                    @endisset
                </h2>
                <p class="text-muted mb-0" style="font-size:.82rem;">
                    @isset($user){{ $user->name }}@else Nouveau client ou administrateur @endisset
                </p>
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
            padding:1.2rem 1.5rem;text-align:center;}
        .form-card-header h4{font-family:'Syne',sans-serif;font-weight:800;color:#fff;margin:0;font-size:1.2rem;}
        .form-card-header p{color:rgba(255,255,255,.5);font-size:.78rem;margin:.3rem 0 0;}

        .field-label{font-family:'Syne',sans-serif;font-weight:700;font-size:.78rem;
            color:var(--navy);text-transform:uppercase;letter-spacing:1px;
            display:flex;align-items:center;gap:.4rem;margin-bottom:.5rem;}
        .field-label i{color:var(--gold);}
        .field-input{border:1.5px solid #dde3ec;border-radius:10px;padding:.65rem .9rem;
            font-size:.9rem;transition:.25s;width:100%;background:#fafbfd;}
        .field-input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(240,165,0,.15);
            background:#fff;outline:none;}

        /* ── ROLE SELECTOR ── */
        .role-grid{display:grid;grid-template-columns:1fr 1fr;gap:.75rem;}
        .role-radio{display:none;}
        .role-label{display:flex;align-items:center;gap:.75rem;padding:.85rem 1rem;
            border:2px solid #e8edf3;border-radius:14px;cursor:pointer;transition:.25s;background:#fafbfd;}
        .role-label .role-icon{font-size:1.6rem;}
        .role-label .role-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.88rem;color:var(--navy);}
        .role-label .role-desc {font-size:.7rem;color:var(--muted);}
        .role-radio:checked + .role-label{border-color:var(--gold);background:rgba(240,165,0,.08);}
        .role-radio:checked + .role-label .role-title{color:var(--gold);}

        .submit-area{background:#f7f8fc;border-top:1px solid #eef1f6;padding:1.5rem;}
        .btn-submit{background:linear-gradient(135deg,var(--gold),var(--gold2));border:none;
            color:var(--navy);font-family:'Syne',sans-serif;font-weight:800;font-size:1rem;
            padding:.75rem 2rem;border-radius:12px;transition:.25s;width:100%;}
        .btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(240,165,0,.4);color:var(--navy);}
        .btn-cancel{background:transparent;border:1.5px solid #dde3ec;color:var(--muted);
            font-weight:600;border-radius:12px;padding:.75rem 1.5rem;transition:.2s;width:100%;
            text-decoration:none;display:flex;align-items:center;justify-content:center;}
        .btn-cancel:hover{border-color:var(--red);color:var(--red);}

        .err-msg{color:var(--red);font-size:.78rem;margin-top:.3rem;display:flex;align-items:center;gap:.3rem;}
        .optional-tag{font-size:.68rem;color:var(--muted);font-weight:400;
            background:#f1f4f9;padding:2px 8px;border-radius:10px;margin-left:.4rem;}

        @media(max-width:480px){
            .role-grid{grid-template-columns:1fr;}
            .submit-area,.form-card .p-4{padding:1rem!important;}
        }
    </style>

    <div class="py-4">
      <div class="container-fluid px-3 px-md-4">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-7 col-xl-6">
            <div class="form-card">

                <div class="form-card-header">
                    <h4>
                        @isset($user) ✏️ Modifier : {{ $user->name }}
                        @else 👤 Nouvel utilisateur @endisset
                    </h4>
                    <p>Remplissez toutes les informations</p>
                </div>

                <form method="POST"
                      action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}">
                    @csrf
                    @isset($user) @method('PUT') @endisset

                    <div class="p-4">

                        {{-- ── RÔLE ── --}}
                        <div class="mb-4">
                            <label class="field-label"><i class="bi bi-shield-fill"></i>Rôle</label>
                            <div class="role-grid">
                                <div>
                                    <input type="radio" name="role" id="role_admin"
                                           class="role-radio" value="admin"
                                           {{ old('role', isset($user) ? $user->role : '') === 'admin' ? 'checked' : '' }}>
                                    <label class="role-label" for="role_admin">
                                        <span class="role-icon">👑</span>
                                        <div>
                                            <div class="role-title">Administrateur</div>
                                            <div class="role-desc">Accès complet</div>
                                        </div>
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="role" id="role_client"
                                           class="role-radio" value="client"
                                           {{ old('role', isset($user) ? $user->role : 'client') === 'client' ? 'checked' : '' }}>
                                    <label class="role-label" for="role_client">
                                        <span class="role-icon">👤</span>
                                        <div>
                                            <div class="role-title">Client</div>
                                            <div class="role-desc">Accès limité</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @error('role')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- ── NOM ── --}}
                        <div class="mb-3">
                            <label class="field-label"><i class="bi bi-person"></i>Nom complet</label>
                            <input type="text" name="name" class="field-input"
                                   placeholder="Prénom et Nom..."
                                   value="{{ old('name', isset($user) ? $user->name : '') }}" required>
                            @error('name')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- ── EMAIL ── --}}
                        <div class="mb-3">
                            <label class="field-label"><i class="bi bi-envelope"></i>Email</label>
                            <input type="email" name="email" class="field-input"
                                   placeholder="exemple@email.com"
                                   value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                            @error('email')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- ── TEL + ADRESSE ── --}}
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-sm-6">
                                <label class="field-label">
                                    <i class="bi bi-telephone"></i>Téléphone
                                    <span class="optional-tag">Optionnel</span>
                                </label>
                                <input type="text" name="telephone" class="field-input"
                                       placeholder="+226 xx xx xx xx"
                                       value="{{ old('telephone', isset($user) ? $user->telephone : '') }}">
                                @error('telephone')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="field-label">
                                    <i class="bi bi-geo-alt"></i>Adresse
                                    <span class="optional-tag">Optionnel</span>
                                </label>
                                <input type="text" name="adresse" class="field-input"
                                       placeholder="Quartier, Ville..."
                                       value="{{ old('adresse', isset($user) ? $user->adresse : '') }}">
                            </div>
                        </div>

                        {{-- ── MOT DE PASSE ── --}}
                        <div class="mb-1">
                            <label class="field-label">
                                <i class="bi bi-lock"></i>Mot de passe
                                @isset($user)<span class="optional-tag">Laisser vide = inchangé</span>@endisset
                            </label>
                        </div>
                        <div class="row g-3 mb-1">
                            <div class="col-12 col-sm-6">
                                <input type="password" name="password" class="field-input"
                                       placeholder="••••••••"
                                       {{ isset($user) ? '' : 'required' }}
                                       autocomplete="new-password">
                                @error('password')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="password" name="password_confirmation" class="field-input"
                                       placeholder="Confirmer..."
                                       autocomplete="new-password">
                            </div>
                        </div>

                    </div>

                    <div class="submit-area">
                        <div class="d-flex gap-3 flex-column flex-sm-row">
                            <a href="{{ route('users.index') }}" class="btn-cancel order-2 order-sm-1">
                                <i class="bi bi-x me-1"></i>Annuler
                            </a>
                            <button type="submit" class="btn-submit order-1 order-sm-2">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                @isset($user) Enregistrer les modifications
                                @else Créer l'utilisateur @endisset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
