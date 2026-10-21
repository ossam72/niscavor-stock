<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('users.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h2 class="m-0">
                    <i class="bi bi-person-gear me-2" style="color:var(--gold,#f0a500)"></i>Modifier l'utilisateur
                </h2>
                <p class="text-muted mb-0" style="font-size:.82rem;">{{ $user->name }}</p>
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

        .form-card-header{
            background:linear-gradient(135deg,var(--navy),var(--navy2));
            padding:1.4rem 1.5rem;
            display:flex;align-items:center;gap:1rem;
        }
        .user-avatar-lg{
            width:56px;height:56px;border-radius:50%;flex-shrink:0;
            background:linear-gradient(135deg,var(--gold),var(--gold2));
            display:flex;align-items:center;justify-content:center;
            font-family:'Syne',sans-serif;font-weight:800;font-size:1.5rem;
            color:var(--navy);border:2px solid rgba(255,255,255,.2);
        }
        .user-avatar-lg.av-client{
            background:linear-gradient(135deg,#0369a1,#0284c7);color:#fff;
        }
        .form-card-header .hd-title{color:#fff;font-family:'Syne',sans-serif;font-weight:800;font-size:1.05rem;margin:0;}
        .form-card-header .hd-sub  {color:rgba(255,255,255,.5);font-size:.78rem;margin:.2rem 0 0;}

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
        .role-label{
            display:flex;align-items:center;gap:.75rem;padding:.85rem 1rem;
            border:2px solid #e8edf3;border-radius:14px;cursor:pointer;
            transition:.25s;background:#fafbfd;
        }
        .role-label .role-icon {font-size:1.6rem;}
        .role-label .role-title{font-family:'Syne',sans-serif;font-weight:700;font-size:.88rem;color:var(--navy);}
        .role-label .role-desc {font-size:.7rem;color:var(--muted);}
        .role-radio:checked + .role-label{border-color:var(--gold);background:rgba(240,165,0,.08);}
        .role-radio:checked + .role-label .role-title{color:var(--gold);}

        /* ── PASSWORD SECTION ── */
        .pwd-section{
            background:#f7f8fc;border:1.5px dashed #dde3ec;
            border-radius:12px;padding:1rem 1.1rem;margin-top:.5rem;
        }
        .pwd-section .pwd-hint{
            font-size:.75rem;color:var(--muted);
            display:flex;align-items:center;gap:.4rem;margin-bottom:.75rem;
        }

        .optional-tag{font-size:.68rem;color:var(--muted);font-weight:400;
            background:#f1f4f9;padding:2px 8px;border-radius:10px;margin-left:.4rem;}

        .submit-area{background:#f7f8fc;border-top:1px solid #eef1f6;padding:1.5rem;}
        .btn-submit{background:linear-gradient(135deg,var(--gold),var(--gold2));border:none;
            color:var(--navy);font-family:'Syne',sans-serif;font-weight:800;font-size:1rem;
            padding:.75rem 2rem;border-radius:12px;transition:.25s;width:100%;}
        .btn-submit:hover{transform:translateY(-2px);box-shadow:0 8px 22px rgba(240,165,0,.4);color:var(--navy);}
        .btn-cancel{background:transparent;border:1.5px solid #dde3ec;color:var(--muted);
            font-weight:600;border-radius:12px;padding:.75rem 1.5rem;transition:.2s;width:100%;
            text-decoration:none;display:flex;align-items:center;justify-content:center;}
        .btn-cancel:hover{border-color:var(--red);color:var(--red);}

        .err-msg{color:var(--red);font-size:.78rem;margin-top:.3rem;
            display:flex;align-items:center;gap:.3rem;}

        /* ── INFO BADGE ── */
        .info-badge{
            display:inline-flex;align-items:center;gap:.4rem;
            background:rgba(240,165,0,.1);border:1px solid rgba(240,165,0,.25);
            border-radius:8px;padding:.4rem .8rem;font-size:.75rem;
            color:#92400e;font-weight:600;margin-bottom:1rem;
        }

        @media(max-width:480px){
            .role-grid{grid-template-columns:1fr;}
            .submit-area,.form-card .p-4{padding:1rem!important;}
            .form-card-header{padding:1rem;}
        }
    </style>

    <div class="py-4">
      <div class="container-fluid px-3 px-md-4">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-7 col-xl-6">
            <div class="form-card">

                {{-- ── HEADER avec avatar ── --}}
                <div class="form-card-header">
                    <div class="user-avatar-lg {{ $user->isClient() ? 'av-client' : '' }}">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="hd-title">✏️ {{ $user->name }}</p>
                        <p class="hd-sub">
                            {{ $user->isAdmin() ? '👑 Administrateur' : '👤 Client' }}
                            — Inscrit le {{ $user->created_at->format('d/m/Y') }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="p-4">

                        {{-- Info --}}
                        @if($user->id === auth()->id())
                        <div class="info-badge">
                            <i class="bi bi-info-circle"></i>
                            Vous modifiez votre propre compte
                        </div>
                        @endif

                        {{-- ── RÔLE ── --}}
                        <div class="mb-4">
                            <label class="field-label"><i class="bi bi-shield-fill"></i>Rôle</label>
                            <div class="role-grid">
                                <div>
                                    <input type="radio" name="role" id="role_admin"
                                           class="role-radio" value="admin"
                                           {{ old('role', $user->role) === 'admin' ? 'checked' : '' }}>
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
                                           {{ old('role', $user->role) === 'client' ? 'checked' : '' }}>
                                    <label class="role-label" for="role_client">
                                        <span class="role-icon">👤</span>
                                        <div>
                                            <div class="role-title">Client</div>
                                            <div class="role-desc">Accès limité</div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @error('role')
                                <div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ── NOM ── --}}
                        <div class="mb-3">
                            <label class="field-label"><i class="bi bi-person"></i>Nom complet</label>
                            <input type="text" name="name" class="field-input"
                                   placeholder="Prénom et Nom..."
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ── EMAIL ── --}}
                        <div class="mb-3">
                            <label class="field-label"><i class="bi bi-envelope"></i>Adresse email</label>
                            <input type="email" name="email" class="field-input"
                                   placeholder="exemple@email.com"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
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
                                       value="{{ old('telephone', $user->telephone) }}">
                                @error('telephone')
                                    <div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="field-label">
                                    <i class="bi bi-geo-alt"></i>Adresse
                                    <span class="optional-tag">Optionnel</span>
                                </label>
                                <input type="text" name="adresse" class="field-input"
                                       placeholder="Quartier, Ville..."
                                       value="{{ old('adresse', $user->adresse) }}">
                            </div>
                        </div>

                        {{-- ── MOT DE PASSE ── --}}
                        <div class="mb-1">
                            <label class="field-label">
                                <i class="bi bi-lock"></i>Mot de passe
                                <span class="optional-tag">Laisser vide = inchangé</span>
                            </label>
                        </div>
                        <div class="pwd-section">
                            <div class="pwd-hint">
                                <i class="bi bi-info-circle"></i>
                                Remplissez uniquement si vous souhaitez changer le mot de passe.
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="password" name="password"
                                           class="field-input"
                                           placeholder="Nouveau mot de passe..."
                                           autocomplete="new-password">
                                    @error('password')
                                        <div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="password" name="password_confirmation"
                                           class="field-input"
                                           placeholder="Confirmer..."
                                           autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- ── BOUTONS ── --}}
                    <div class="submit-area">
                        <div class="d-flex gap-3 flex-column flex-sm-row">
                            <a href="{{ route('users.index') }}" class="btn-cancel order-2 order-sm-1">
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
</x-app-layout>
