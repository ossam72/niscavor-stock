<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <div>
                <h2 class="m-0"><i class="bi bi-person-circle me-2" style="color:var(--gold,#f0a500)"></i>Mon Profil</h2>
                <p class="text-muted mb-0" style="font-size:.82rem;">Gérez vos informations personnelles</p>
            </div>
        </div>
    </x-slot>

    <style>
        :root{--navy:#0d1b2a;--navy2:#1b2a3d;--gold:#f0a500;--gold2:#ffc642;
              --red:#e63946;--green:#2ec4b6;--light:#f7f8fc;--muted:#8494a7;
              --radius:16px;--shadow:0 4px 24px rgba(13,27,42,.10);}
        body{background:var(--light);font-family:'DM Sans',sans-serif;}
        h1,h2,h3,h4,h5,h6{font-family:'Syne',sans-serif;}

        .profile-card{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow);overflow:hidden;margin-bottom:1.5rem;}
        .profile-card-header{
            background:linear-gradient(135deg,var(--navy),var(--navy2));
            padding:1.2rem 1.5rem;display:flex;align-items:center;gap:.6rem;
        }
        .profile-card-header i{color:var(--gold);font-size:1.1rem;}
        .profile-card-header span{color:#fff;font-family:'Syne',sans-serif;font-weight:700;font-size:1rem;}
        .profile-card-header small{color:rgba(255,255,255,.5);font-size:.75rem;margin-left:auto;}

        .field-label{font-family:'Syne',sans-serif;font-weight:700;font-size:.78rem;
            color:var(--navy);text-transform:uppercase;letter-spacing:1px;
            display:flex;align-items:center;gap:.4rem;margin-bottom:.5rem;}
        .field-label i{color:var(--gold);}
        .field-input{border:1.5px solid #dde3ec;border-radius:10px;padding:.65rem .9rem;
            font-size:.9rem;transition:.25s;width:100%;background:#fafbfd;}
        .field-input:focus{border-color:var(--gold);box-shadow:0 0 0 3px rgba(240,165,0,.15);
            background:#fff;outline:none;}

        .btn-save{background:linear-gradient(135deg,var(--gold),var(--gold2));border:none;
            color:var(--navy);font-family:'Syne',sans-serif;font-weight:800;
            border-radius:10px;padding:.6rem 1.8rem;transition:.25s;}
        .btn-save:hover{transform:translateY(-2px);box-shadow:0 6px 18px rgba(240,165,0,.4);color:var(--navy);}

        .btn-danger-nv{background:rgba(230,57,70,.1);border:1.5px solid rgba(230,57,70,.3);
            color:var(--red);font-family:'Syne',sans-serif;font-weight:700;
            border-radius:10px;padding:.6rem 1.8rem;transition:.25s;}
        .btn-danger-nv:hover{background:var(--red);color:#fff;}

        .alert-success-nv{background:rgba(46,196,182,.1);border-left:4px solid var(--green);
            border-radius:10px;color:#065f52;padding:.75rem 1rem;font-weight:500;
            display:flex;align-items:center;gap:.5rem;}
        .err-msg{color:var(--red);font-size:.78rem;margin-top:.3rem;
            display:flex;align-items:center;gap:.3rem;}

        /* Avatar placeholder */
        .avatar-circle{
            width:72px;height:72px;border-radius:50%;
            background:linear-gradient(135deg,var(--gold),var(--gold2));
            display:flex;align-items:center;justify-content:center;
            font-family:'Syne',sans-serif;font-weight:800;font-size:1.8rem;
            color:var(--navy);flex-shrink:0;
            box-shadow:0 4px 16px rgba(240,165,0,.35);
        }

        /* Modal suppression */
        .modal-nv .modal-content{border-radius:20px;border:none;box-shadow:0 20px 60px rgba(0,0,0,.25);}
        .modal-nv .modal-header{background:linear-gradient(135deg,var(--red),#c0392b);
            border-radius:20px 20px 0 0;border:none;padding:1.2rem 1.5rem;}
        .modal-nv .modal-header .modal-title{color:#fff;font-family:'Syne',sans-serif;font-weight:800;}
        .modal-nv .modal-header .btn-close{filter:brightness(10);}

        @media(max-width:575px){
            .profile-card-header{padding:.9rem 1rem;}
            .profile-card .p-4{padding:1rem!important;}
        }
    </style>

    <div class="py-4">
      <div class="container-fluid px-3 px-md-4" style="max-width:900px;margin:0 auto;">

        {{-- ── AVATAR + NOM ── --}}
        <div class="profile-card">
            <div class="p-4 d-flex align-items-center gap-3 flex-wrap">
                <div class="avatar-circle">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.3rem;color:var(--navy);">
                        {{ Auth::user()->name }}
                    </div>
                    <div style="color:var(--muted);font-size:.85rem;">
                        <i class="bi bi-envelope me-1"></i>{{ Auth::user()->email }}
                    </div>
                    <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem;">
                        <i class="bi bi-calendar3 me-1"></i>Membre depuis {{ Auth::user()->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- ── INFOS PROFIL ── --}}
        <div class="profile-card">
            <div class="profile-card-header">
                <i class="bi bi-person-fill"></i>
                <span>Informations personnelles</span>
                <small>Nom & Email</small>
            </div>
            <div class="p-4">
                @if(session('status') === 'profile-updated')
                <div class="alert-success-nv mb-3">
                    <i class="bi bi-check-circle-fill"></i>Profil mis à jour avec succès !
                </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf @method('patch')

                    <div class="mb-3">
                        <label class="field-label"><i class="bi bi-person"></i>Nom complet</label>
                        <input type="text" name="name" class="field-input"
                               value="{{ old('name', $user->name) }}" required autofocus>
                        @error('name')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="field-label"><i class="bi bi-envelope"></i>Adresse email</label>
                        <input type="email" name="email" class="field-input"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>@enderror
                    </div>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-circle me-2"></i>Enregistrer
                    </button>
                </form>
            </div>
        </div>

        {{-- ── MOT DE PASSE ── --}}
        <div class="profile-card">
            <div class="profile-card-header">
                <i class="bi bi-shield-lock-fill"></i>
                <span>Sécurité — Mot de passe</span>
                <small>Changement</small>
            </div>
            <div class="p-4">
                @if(session('status') === 'password-updated')
                <div class="alert-success-nv mb-3">
                    <i class="bi bi-check-circle-fill"></i>Mot de passe mis à jour !
                </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf @method('put')

                    <div class="mb-3">
                        <label class="field-label"><i class="bi bi-lock"></i>Mot de passe actuel</label>
                        <input type="password" name="current_password" class="field-input"
                               placeholder="••••••••" autocomplete="current-password">
                        @error('current_password', 'updatePassword')
                            <div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-sm-6">
                            <label class="field-label"><i class="bi bi-lock-fill"></i>Nouveau mot de passe</label>
                            <input type="password" name="password" class="field-input"
                                   placeholder="••••••••" autocomplete="new-password">
                            @error('password', 'updatePassword')
                                <div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label class="field-label"><i class="bi bi-shield-check"></i>Confirmation</label>
                            <input type="password" name="password_confirmation" class="field-input"
                                   placeholder="••••••••" autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-shield-check me-2"></i>Mettre à jour
                    </button>
                </form>
            </div>
        </div>

        {{-- ── SUPPRIMER COMPTE ── --}}
        <div class="profile-card">
            <div class="profile-card-header" style="background:linear-gradient(135deg,#7f1d1d,#991b1b);">
                <i class="bi bi-exclamation-triangle-fill" style="color:#fca5a5;"></i>
                <span>Zone dangereuse</span>
                <small style="color:rgba(255,255,255,.5);">Irréversible</small>
            </div>
            <div class="p-4">
                <p style="color:var(--muted);font-size:.88rem;margin-bottom:1rem;">
                    <i class="bi bi-info-circle me-1"></i>
                    La suppression de votre compte est définitive. Toutes vos données seront perdues.
                </p>
                <button type="button" class="btn-danger-nv" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash me-2"></i>Supprimer mon compte
                </button>
            </div>
        </div>

      </div>
    </div>

    {{-- ── MODAL SUPPRESSION ── --}}
    <div class="modal fade modal-nv" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-exclamation-triangle me-2"></i>Supprimer le compte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <p style="color:var(--navy);font-size:.9rem;">
                        Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est <strong>irréversible</strong>.
                    </p>
                    <form method="POST" action="{{ route('profile.destroy') }}" id="deleteForm">
                        @csrf @method('delete')
                        <div class="mb-3">
                            <label class="field-label"><i class="bi bi-lock"></i>Confirmez avec votre mot de passe</label>
                            <input type="password" name="password" class="field-input"
                                   placeholder="Votre mot de passe" required>
                            @error('password', 'userDeletion')
                                <div class="err-msg"><i class="bi bi-exclamation-circle"></i>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger fw-bold">
                                <i class="bi bi-trash me-1"></i>Supprimer définitivement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
