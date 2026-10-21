<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Niscavor Stock — Gestion de Cave à Boissons</title>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,300;0,400;0,600;0,700;0,800;0,900;1,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
    /* ══════════════════════════════════════════════
       TOKENS
    ══════════════════════════════════════════════ */
    :root {
        --bg:      #07090F;
        --bg2:     #0D1018;
        --bg3:     #131720;
        --gold:    #F0A500;
        --gold2:   #FFD166;
        --green:   #10B981;
        --red:     #EF4444;
        --blue:    #3B82F6;
        --purple:  #8B5CF6;
        --white:   #FFFFFF;
        --txt:     #E2E8F4;
        --muted:   #64748B;
        --border:  rgba(255,255,255,0.07);
        --gold-glow: rgba(240,165,0,0.15);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body {
        font-family: 'Urbanist', sans-serif;
        background: var(--bg);
        color: var(--txt);
        overflow-x: hidden;
    }
    img { display: block; }

    /* ══════════════════════════════════════════════
       NAVBAR
    ══════════════════════════════════════════════ */
    .navbar-nv {
        position: fixed; top: 0; left: 0; right: 0; z-index: 200;
        height: 66px;
        background: rgba(7,9,15,0.88);
        backdrop-filter: blur(20px) saturate(180%);
        border-bottom: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
        padding: 0 6%;
        transition: background .3s;
    }
    .nav-logo {
        display: flex; align-items: center; gap: 10px;
        text-decoration: none; color: inherit;
    }
    .nav-logo-icon {
        width: 34px; height: 34px;
        background: linear-gradient(135deg, var(--gold), var(--gold2));
        border-radius: 8px;
        display: grid; place-items: center;
        font-weight: 900; font-size: 15px; color: #000;
        box-shadow: 0 4px 16px rgba(240,165,0,0.35);
        flex-shrink: 0;
    }
    .nav-logo-text {
        font-size: 17px; font-weight: 800; color: #fff; letter-spacing: -.3px;
    }
    .nav-logo-text span { color: var(--gold); }
    .nav-status {
        display: flex; align-items: center; gap: 6px;
        font-size: 11px; font-weight: 700; color: var(--green);
        background: rgba(16,185,129,0.08);
        border: 1px solid rgba(16,185,129,0.2);
        padding: 4px 12px; border-radius: 20px;
        letter-spacing: .5px;
    }
    .status-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: var(--green);
        animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse {
        0%,100% { box-shadow: 0 0 0 0 rgba(16,185,129,.4); }
        50%      { box-shadow: 0 0 0 5px rgba(16,185,129,0); }
    }
    .nav-actions { display: flex; align-items: center; gap: 8px; }
    .btn-nav-ghost {
        color: rgba(255,255,255,.65); font-size: 13px; font-weight: 600;
        padding: 7px 18px; border-radius: 7px; text-decoration: none;
        border: 1px solid var(--border); transition: .2s;
    }
    .btn-nav-ghost:hover { color: #fff; border-color: rgba(255,255,255,.25); }
    .btn-nav-main {
        background: var(--gold); color: #000; font-size: 13px; font-weight: 800;
        padding: 8px 22px; border-radius: 7px; text-decoration: none;
        transition: .2s; letter-spacing: .2px;
        box-shadow: 0 4px 14px rgba(240,165,0,0.3);
    }
    .btn-nav-main:hover { background: var(--gold2); color: #000; transform: translateY(-1px); }
    @media(max-width:640px) {
        .nav-status { display: none; }
        .btn-nav-ghost { display: none; }
        .navbar-nv { padding: 0 5%; }
    }

    /* ══════════════════════════════════════════════
       HERO
    ══════════════════════════════════════════════ */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex; align-items: center;
        overflow: hidden;
        padding: 100px 6% 80px;
    }
    /* Fond photo entrepôt */
    .hero-bg {
        position: absolute; inset: 0; z-index: 0;
    }
    .hero-bg img {
        width: 100%; height: 100%; object-fit: cover;
        object-position: center 40%;
    }
    .hero-bg-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(
            105deg,
            rgba(7,9,15,0.97) 0%,
            rgba(7,9,15,0.85) 45%,
            rgba(7,9,15,0.4)  75%,
            rgba(7,9,15,0.6)  100%
        );
    }
    .hero-inner {
        position: relative; z-index: 2;
        max-width: 1280px; margin: 0 auto; width: 100%;
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 60px; align-items: center;
    }
    @media(max-width:900px) {
        .hero-inner { grid-template-columns: 1fr; }
        .hero-right  { display: none; }
    }

    /* HERO LEFT */
    .hero-tag {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: 10px; font-weight: 800; letter-spacing: 2.5px;
        text-transform: uppercase; color: var(--gold);
        background: rgba(240,165,0,0.08);
        border: 1px solid rgba(240,165,0,0.22);
        padding: 5px 14px; border-radius: 20px; margin-bottom: 26px;
    }
    .hero-tag-dot { width: 5px; height: 5px; background: var(--gold); border-radius: 50%; }
    .hero-h1 {
        font-size: clamp(2.8rem, 5.5vw, 5rem);
        font-weight: 900; line-height: 1.02;
        letter-spacing: -2px; color: #fff; margin-bottom: 22px;
    }
    .hero-h1 .gradient-text {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold2) 60%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
        font-style: italic;
    }
    .hero-h1 .dim { color: rgba(255,255,255,0.35); }
    .hero-p {
        font-size: 16px; font-weight: 400; color: rgba(255,255,255,0.5);
        line-height: 1.8; max-width: 480px; margin-bottom: 38px;
    }
    .hero-btns { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 52px; }
    .btn-hero-main {
        display: inline-flex; align-items: center; gap: 9px;
        background: var(--gold); color: #000; font-size: 15px; font-weight: 800;
        padding: 14px 32px; border-radius: 9px; text-decoration: none;
        box-shadow: 0 8px 24px rgba(240,165,0,0.3); transition: .25s;
    }
    .btn-hero-main:hover { background: var(--gold2); color: #000; transform: translateY(-2px); box-shadow: 0 14px 32px rgba(240,165,0,.4); }
    .btn-hero-ghost {
        display: inline-flex; align-items: center; gap: 9px;
        background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.8);
        font-size: 15px; font-weight: 600;
        padding: 14px 28px; border-radius: 9px; text-decoration: none;
        border: 1px solid rgba(255,255,255,0.12); transition: .2s;
    }
    .btn-hero-ghost:hover { background: rgba(255,255,255,.1); color: #fff; }

    /* HERO STATS */
    .hero-stats {
        display: flex; gap: 32px; flex-wrap: wrap;
        padding-top: 28px; border-top: 1px solid var(--border);
    }
    .hstat { }
    .hstat-val {
        font-size: 2rem; font-weight: 900; color: #fff; letter-spacing: -1px; line-height: 1;
    }
    .hstat-val .u { font-size: 1rem; color: var(--gold); margin-left: 2px; }
    .hstat-lbl { font-size: 11px; color: var(--muted); font-weight: 600; margin-top: 4px; text-transform: uppercase; letter-spacing: .5px; }

    /* HERO RIGHT — floating bottles */
    .hero-right { position: relative; height: 520px; }
    .bottle-float {
        position: absolute;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.6);
        border: 1px solid rgba(255,255,255,0.08);
        transition: transform 6s ease-in-out;
    }
    .bottle-float img { width: 100%; height: 100%; object-fit: cover; }
    .bottle-float .bf-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(7,9,15,0.85) 0%, transparent 55%);
    }
    .bottle-float .bf-label {
        position: absolute; bottom: 12px; left: 12px; right: 12px;
    }
    .bf-cat {
        font-size: 9px; font-weight: 800; letter-spacing: 1.5px;
        text-transform: uppercase; margin-bottom: 3px;
    }
    .bf-name { font-size: 13px; font-weight: 800; color: #fff; }
    .bf-prix { font-size: 12px; font-weight: 700; color: var(--gold); margin-top: 2px; }

    .bf-1 { width: 175px; height: 220px; top: 0;   left: 0; animation: float1 7s ease-in-out infinite; }
    .bf-2 { width: 145px; height: 185px; top: 30px; left: 190px; animation: float2 8s ease-in-out infinite; }
    .bf-3 { width: 155px; height: 200px; top: 260px; left: 20px; animation: float3 9s ease-in-out infinite; }
    .bf-4 { width: 165px; height: 210px; top: 220px; left: 180px; animation: float1 10s ease-in-out infinite reverse; }
    .bf-5 { width: 130px; height: 165px; top: 120px; left: 355px; animation: float2 6s ease-in-out infinite; }

    @keyframes float1 { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-14px); } }
    @keyframes float2 { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    @keyframes float3 { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-18px); } }

    /* ══════════════════════════════════════════════
       TICKER
    ══════════════════════════════════════════════ */
    .ticker-wrap {
        background: var(--gold);
        overflow: hidden; height: 42px;
        display: flex; align-items: center;
    }
    .ticker-inner {
        display: flex; gap: 0;
        animation: ticker 22s linear infinite;
        white-space: nowrap;
        flex-shrink: 0;
    }
    .ticker-item {
        font-size: 12px; font-weight: 800; color: #000;
        padding: 0 24px; letter-spacing: 1px; text-transform: uppercase;
        display: flex; align-items: center; gap: 10px;
    }
    .ticker-sep { color: rgba(0,0,0,0.3); }
    @keyframes ticker { from { transform: translateX(0); } to { transform: translateX(-50%); } }

    /* ══════════════════════════════════════════════
       SECTION : ENTREPÔT PHOTOS
    ══════════════════════════════════════════════ */
    .warehouse-section {
        padding: 100px 6%;
        background: var(--bg);
    }
    .ws-inner { max-width: 1280px; margin: 0 auto; }
    .section-eyebrow {
        font-size: 10px; font-weight: 800; color: var(--gold);
        letter-spacing: 3px; text-transform: uppercase; margin-bottom: 14px;
        display: flex; align-items: center; gap: 10px;
    }
    .section-eyebrow::after { content: ''; flex: 0 0 40px; height: 1px; background: var(--gold); opacity: .4; }
    .section-h2 {
        font-size: clamp(2rem, 4vw, 3.2rem);
        font-weight: 900; color: #fff; letter-spacing: -1.5px;
        line-height: 1.05; margin-bottom: 12px;
    }
    .section-h2 em { font-style: italic; color: var(--gold); }
    .section-sub {
        font-size: 15px; color: var(--muted); line-height: 1.75;
        max-width: 520px; margin-bottom: 52px;
    }

    /* Photo mosaic */
    .photo-mosaic {
        display: grid;
        grid-template-columns: 1.5fr 1fr 1fr;
        grid-template-rows: 280px 240px;
        gap: 6px;
        border-radius: 16px; overflow: hidden;
    }
    @media(max-width:768px) {
        .photo-mosaic { grid-template-columns: 1fr 1fr; grid-template-rows: 200px 200px 200px; }
        .pm-big { grid-column: span 2; grid-row: span 1; }
    }
    .pm-photo {
        position: relative; overflow: hidden; cursor: default;
    }
    .pm-big { grid-row: span 2; }
    .pm-photo img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform .7s ease; filter: brightness(.7) saturate(.9);
    }
    .pm-photo:hover img { transform: scale(1.06); filter: brightness(.9) saturate(1.1); }
    .pm-photo-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(7,9,15,.85) 0%, rgba(7,9,15,.1) 50%);
    }
    .pm-label {
        position: absolute; bottom: 0; left: 0; right: 0;
        padding: 20px 18px 16px;
    }
    .pm-tag {
        font-size: 9px; font-weight: 800; color: var(--gold);
        letter-spacing: 2px; text-transform: uppercase; margin-bottom: 5px;
    }
    .pm-title { font-size: 15px; font-weight: 800; color: #fff; line-height: 1.25; }
    .pm-big .pm-title { font-size: 20px; }

    /* ══════════════════════════════════════════════
       SECTION : CATALOGUE BOISSONS (VRAIES PHOTOS)
    ══════════════════════════════════════════════ */
    .catalog-section {
        padding: 100px 6%;
        background: var(--bg2);
        border-top: 1px solid var(--border);
    }
    .catalog-inner { max-width: 1280px; margin: 0 auto; }

    /* Category filter pills */
    .cat-filters { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 36px; }
    .cf-pill {
        padding: 7px 18px; border-radius: 20px; font-size: 12px; font-weight: 700;
        border: 1px solid var(--border); color: var(--muted);
        background: transparent; cursor: pointer; transition: .2s;
    }
    .cf-pill:hover { border-color: rgba(240,165,0,.3); color: var(--gold); }
    .cf-pill.active {
        background: rgba(240,165,0,.1); border-color: rgba(240,165,0,.4); color: var(--gold);
    }

    /* Drink cards grid */
    .drinks-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 14px;
    }
    .drink-card {
        background: var(--bg3); border: 1px solid var(--border);
        border-radius: 14px; overflow: hidden;
        transition: transform .25s, box-shadow .25s, border-color .25s;
        cursor: default;
    }
    .drink-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        border-color: rgba(240,165,0,0.3);
    }
    .drink-img-wrap {
        position: relative; height: 140px; overflow: hidden;
        background: linear-gradient(135deg, #131720, #1a1f2e);
    }
    .drink-img-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        transition: transform .4s ease; filter: brightness(.85);
    }
    .drink-card:hover .drink-img-wrap img { transform: scale(1.08); filter: brightness(1); }
    .drink-stock-badge {
        position: absolute; top: 8px; right: 8px;
        font-size: 9px; font-weight: 800; padding: 3px 8px; border-radius: 20px;
        letter-spacing: .3px;
    }
    .badge-ok   { background: rgba(16,185,129,.2);  color: #10B981; border: 1px solid rgba(16,185,129,.3); }
    .badge-low  { background: rgba(240,165,0,.2);   color: var(--gold); border: 1px solid rgba(240,165,0,.3); }
    .badge-out  { background: rgba(239,68,68,.2);   color: #EF4444; border: 1px solid rgba(239,68,68,.3); }
    .drink-info { padding: 12px 13px 14px; }
    .drink-cat-label {
        font-size: 9px; font-weight: 800; text-transform: uppercase;
        letter-spacing: 1.5px; margin-bottom: 5px;
    }
    .cat-biere  { color: var(--gold); }
    .cat-jus    { color: var(--green); }
    .cat-vin    { color: #F87171; }
    .cat-eau    { color: var(--blue); }
    .drink-name { font-size: 13px; font-weight: 800; color: #fff; margin-bottom: 8px; line-height: 1.2; }
    .drink-footer {
        display: flex; align-items: center; justify-content: space-between;
        padding-top: 8px; border-top: 1px solid var(--border);
    }
    .drink-price { font-size: 14px; font-weight: 900; color: #fff; }
    .drink-qty   { font-size: 10px; color: var(--muted); font-weight: 600; }

    /* ══════════════════════════════════════════════
       SECTION : MODULES / FEATURES
    ══════════════════════════════════════════════ */
    .features-section {
        padding: 100px 6%;
        background: var(--bg);
        border-top: 1px solid var(--border);
    }
    .features-inner { max-width: 1280px; margin: 0 auto; }
    .features-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 2px; background: var(--border);
        border-radius: 16px; overflow: hidden;
        margin-top: 52px;
    }
    @media(max-width:768px) { .features-grid { grid-template-columns: 1fr; } }
    .feature-cell {
        background: var(--bg2); padding: 40px 32px;
        position: relative; overflow: hidden; transition: .25s;
    }
    .feature-cell:hover { background: var(--bg3); }
    .feature-cell::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px;
        border-radius: 2px 2px 0 0;
    }
    .fc-gold::before   { background: linear-gradient(90deg, var(--gold), var(--gold2)); }
    .fc-green::before  { background: linear-gradient(90deg, var(--green), #34D399); }
    .fc-blue::before   { background: linear-gradient(90deg, var(--blue), #60A5FA); }
    .feature-num {
        font-size: 9px; font-weight: 800; color: var(--muted);
        letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px;
    }
    .feature-icon {
        width: 52px; height: 52px; border-radius: 12px;
        border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; margin-bottom: 20px;
        background: rgba(255,255,255,0.03);
    }
    .feature-title { font-size: 18px; font-weight: 800; color: #fff; margin-bottom: 10px; }
    .feature-desc  { font-size: 13px; color: var(--muted); line-height: 1.75; margin-bottom: 20px; }
    .feature-tag {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 10px; color: var(--muted); font-weight: 700;
        border: 1px solid var(--border); padding: 4px 10px; border-radius: 5px;
        font-family: monospace;
    }

    /* ══════════════════════════════════════════════
       SECTION : PHOTO PLEINE LARGEUR + LISTE
    ══════════════════════════════════════════════ */
    .fullphoto-section {
        padding: 100px 6%;
        background: var(--bg2);
        border-top: 1px solid var(--border);
    }
    .fp-inner {
        max-width: 1280px; margin: 0 auto;
        display: grid; grid-template-columns: 1fr 1fr;
        gap: 70px; align-items: center;
    }
    @media(max-width:860px) { .fp-inner { grid-template-columns: 1fr; } }
    .fp-photo-wrap {
        position: relative; border-radius: 16px; overflow: hidden;
        height: 500px;
    }
    .fp-photo-wrap img {
        width: 100%; height: 100%; object-fit: cover;
        filter: brightness(.65) saturate(.8);
        transition: transform .6s ease;
    }
    .fp-photo-wrap:hover img { transform: scale(1.03); filter: brightness(.75) saturate(1); }
    .fp-photo-gradient {
        position: absolute; inset: 0;
        background: linear-gradient(135deg, rgba(240,165,0,.08), rgba(7,9,15,0.5));
    }
    .fp-stat-chip {
        position: absolute; bottom: 24px; left: 24px;
        background: rgba(7,9,15,.88); border: 1px solid rgba(240,165,0,.25);
        backdrop-filter: blur(10px);
        border-radius: 12px; padding: 14px 18px;
        display: flex; align-items: center; gap: 14px;
    }
    .fsc-icon { font-size: 26px; }
    .fsc-val { font-size: 20px; font-weight: 900; color: var(--gold); letter-spacing: -1px; line-height: 1; }
    .fsc-lbl { font-size: 10px; color: var(--muted); font-weight: 600; text-transform: uppercase; letter-spacing: .5px; margin-top: 2px; }

    .fp-content {}
    .checklist { list-style: none; margin-top: 28px; }
    .checklist li {
        display: flex; align-items: flex-start; gap: 14px;
        padding: 16px 0; border-bottom: 1px solid var(--border);
        font-size: 14px; line-height: 1.65;
    }
    .checklist li:last-child { border-bottom: none; }
    .check-icon {
        width: 22px; height: 22px; flex-shrink: 0; margin-top: 1px;
        background: rgba(16,185,129,.12); border: 1px solid rgba(16,185,129,.25);
        border-radius: 50%; display: grid; place-items: center;
        color: var(--green); font-size: 11px;
    }
    .checklist li strong { color: #fff; }
    .checklist li span  { color: var(--muted); }

    /* ══════════════════════════════════════════════
       CTA SECTION
    ══════════════════════════════════════════════ */
    .cta-section {
        position: relative; overflow: hidden;
        padding: 110px 6%;
        background: var(--bg);
        border-top: 1px solid var(--border);
        text-align: center;
    }
    .cta-glow {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
        width: 600px; height: 400px; border-radius: 50%;
        background: radial-gradient(ellipse, rgba(240,165,0,.08) 0%, transparent 70%);
        pointer-events: none;
    }
    .cta-inner { position: relative; z-index: 2; max-width: 580px; margin: 0 auto; }
    .cta-h2 {
        font-size: clamp(2.2rem, 4.5vw, 3.8rem);
        font-weight: 900; color: #fff; letter-spacing: -2px;
        line-height: 1.05; margin-bottom: 16px;
    }
    .cta-h2 .gradient-text {
        background: linear-gradient(135deg, var(--gold), var(--gold2));
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .cta-p {
        font-size: 16px; color: var(--muted); line-height: 1.75;
        max-width: 460px; margin: 0 auto 36px;
    }
    .cta-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

    /* ══════════════════════════════════════════════
       FOOTER
    ══════════════════════════════════════════════ */
    .footer-nv {
        background: var(--bg);
        border-top: 1px solid var(--border);
        padding: 28px 6%;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 12px;
    }
    .footer-brand { font-size: 14px; font-weight: 800; color: rgba(255,255,255,.3); }
    .footer-brand span { color: var(--gold); }
    .footer-info { font-size: 11px; color: rgba(255,255,255,.2); }
    </style>
</head>
<body>

{{-- ══════════════ NAVBAR ══════════════ --}}
<nav class="navbar-nv">
    <a href="{{ route('home') }}" class="nav-logo">
        <div class="nav-logo-icon">N</div>
        <div class="nav-logo-text">Niscavor<span>Stock</span></div>
    </a>
    <div class="nav-status">
        <div class="status-dot"></div>
        Système actif
    </div>
    <div class="nav-actions">
        <a href="{{ route('login') }}" class="btn-nav-ghost">
            <i class="bi bi-box-arrow-in-right me-1"></i>Connexion
        </a>
        <a href="{{ route('register') }}" class="btn-nav-main">
            S'inscrire →
        </a>
    </div>
</nav>

{{-- ══════════════ HERO ══════════════ --}}
<section class="hero">
    {{-- Fond : photo entrepôt réfrigéré boissons --}}
    <div class="hero-bg">
        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1800&q=85&auto=format"
             alt="Entrepôt automatisé boissons" loading="eager">
        <div class="hero-bg-overlay"></div>
    </div>

    <div class="hero-inner">
        {{-- LEFT --}}
        <div class="hero-left">
            <div class="hero-tag">
                <div class="hero-tag-dot"></div>
                Gestion de cave à boissons
            </div>
            <h1 class="hero-h1">
                <span class="dim">Votre cave,</span><br>
                <span class="gradient-text">sous contrôle.</span><br>
                Toujours.
            </h1>
            <p class="hero-p">
                Gérez votre stock de boissons, enregistrez vos ventes et analysez vos performances —
                depuis une interface moderne, rapide et accessible à tous.
            </p>
            <div class="hero-btns">
                <a href="{{ route('register') }}" class="btn-hero-main">
                    <i class="bi bi-rocket-takeoff-fill"></i>
                    Commencer maintenant
                </a>
                <a href="{{ route('login') }}" class="btn-hero-ghost">
                    <i class="bi bi-play-circle"></i>
                    Se connecter
                </a>
            </div>
            <div class="hero-stats">
                <div class="hstat">
                    <div class="hstat-val">{{ \App\Models\Drink::count() }}<span class="u">+</span></div>
                    <div class="hstat-lbl">Boissons</div>
                </div>
                <div class="hstat">
                    <div class="hstat-val">4<span class="u"> cat.</span></div>
                    <div class="hstat-lbl">Catégories</div>
                </div>
                <div class="hstat">
                    <div class="hstat-val">100<span class="u">%</span></div>
                    <div class="hstat-lbl">Temps réel</div>
                </div>
            </div>
        </div>

        {{-- RIGHT — bouteilles flottantes avec vraies photos --}}
        <div class="hero-right">
            {{-- Photos Unsplash libres de droits représentant les types de boissons --}}
            <div class="bottle-float bf-1">
                <img src="https://images.unsplash.com/photo-1608270586620-248524c67de9?w=300&q=80" alt="Bière">
                <div class="bf-overlay"></div>
                <div class="bf-label">
                    <div class="bf-cat" style="color:#E9A020;">Bière</div>
                    <div class="bf-name">Leffe Blonde</div>
                    <div class="bf-prix">500 FCFA</div>
                </div>
            </div>
            <div class="bottle-float bf-2">
                <img src="https://images.unsplash.com/photo-1581006852262-e4307cf6283a?w=250&q=80" alt="Coca-Cola">
                <div class="bf-overlay"></div>
                <div class="bf-label">
                    <div class="bf-cat" style="color:#10B981;">Jus</div>
                    <div class="bf-name">Coca-Cola</div>
                    <div class="bf-prix">500 FCFA</div>
                </div>
            </div>
            <div class="bottle-float bf-3">
                <img src="https://images.unsplash.com/photo-1474722883778-792e7990302f?w=260&q=80" alt="Vin rouge">
                <div class="bf-overlay"></div>
                <div class="bf-label">
                    <div class="bf-cat" style="color:#F87171;">Vin</div>
                    <div class="bf-name">Jean Bouchard</div>
                    <div class="bf-prix">10 000 FCFA</div>
                </div>
            </div>
            <div class="bottle-float bf-4">
                <img src="https://images.unsplash.com/photo-1622483767028-3f66f32aef97?w=280&q=80" alt="Energy drink">
                <div class="bf-overlay"></div>
                <div class="bf-label">
                    <div class="bf-cat" style="color:#10B981;">Jus</div>
                    <div class="bf-name">Prime Energy</div>
                    <div class="bf-prix">1 000 FCFA</div>
                </div>
            </div>
            <div class="bottle-float bf-5">
                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=220&q=80" alt="Eau">
                <div class="bf-overlay"></div>
                <div class="bf-label">
                    <div class="bf-cat" style="color:#3B82F6;">Eau</div>
                    <div class="bf-name">Power Ade</div>
                    <div class="bf-prix">400 FCFA</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ TICKER ══════════════ --}}
<div class="ticker-wrap">
    <div class="ticker-inner">
        {{-- Répété 2× pour la boucle infinie --}}
        @php
            $tickers = ['Bière Leffe — 500 FCFA','Coca-Cola — 500 FCFA','Fanta — 500 FCFA','Prime Energy — 1 000 FCFA','Red Bull — 500 FCFA','Vin Jean Bouchard — 10 000 FCFA','Power Ade — 400 FCFA','Liquid Death — 500 FCFA','Jus Lipton — 500 FCFA','Bière Blanc — 600 FCFA'];
        @endphp
        @foreach(array_merge($tickers, $tickers) as $t)
        <div class="ticker-item">
            <span>{{ $t }}</span>
            <span class="ticker-sep">◆</span>
        </div>
        @endforeach
    </div>
</div>

{{-- ══════════════ ENTREPÔT PHOTOS ══════════════ --}}
<section class="warehouse-section">
    <div class="ws-inner">
        <div class="row g-5 align-items-end mb-5">
            <div class="col-lg-5">
                <div class="section-eyebrow">Infrastructure</div>
                <h2 class="section-h2">
                    Géré comme<br>les <em>grands entrepôts.</em>
                </h2>
                <p class="section-sub">
                    Les plus grandes chaînes de distribution de boissons au monde automatisent leur logistique.
                    Niscavor Stock vous donne les mêmes outils de suivi, à votre échelle.
                </p>
            </div>
        </div>

        {{-- Mosaïque de photos d'entrepôts et de boissons --}}
        <div class="photo-mosaic">

            {{-- Grande photo entrepôt automatisé --}}
            <div class="pm-photo pm-big">
                <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=900&q=80&auto=format"
                     alt="Entrepôt automatisé boissons" loading="lazy">
                <div class="pm-photo-overlay"></div>
                <div class="pm-label">
                    <div class="pm-tag">Stockage haute densité</div>
                    <div class="pm-title">Entrepôt réfrigéré automatisé</div>
                </div>
            </div>

            {{-- Photo robots / convoyeurs --}}
            <div class="pm-photo">
                <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?w=600&q=80&auto=format"
                     alt="Robots entrepôt logistique" loading="lazy">
                <div class="pm-photo-overlay"></div>
                <div class="pm-label">
                    <div class="pm-tag">Robotique</div>
                    <div class="pm-title">Préparation automatisée</div>
                </div>
            </div>

            {{-- Photo chaîne de production boissons --}}
            <div class="pm-photo">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&q=80&auto=format"
                     alt="Bouteilles sur chaîne de production" loading="lazy">
                <div class="pm-photo-overlay"></div>
                <div class="pm-label">
                    <div class="pm-tag">Production</div>
                    <div class="pm-title">Ligne d'embouteillage</div>
                </div>
            </div>

            {{-- Photo rayonnages boissons --}}
            <div class="pm-photo">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&q=80&auto=format"
                     alt="Rayons boissons distribution" loading="lazy">
                <div class="pm-photo-overlay"></div>
                <div class="pm-label">
                    <div class="pm-tag">Distribution</div>
                    <div class="pm-title">Rayonnages organisés</div>
                </div>
            </div>

            {{-- Photo tracking logistique --}}
            <div class="pm-photo">
                <img src="https://images.unsplash.com/photo-1493217465235-252dd9c0d632?w=600&q=80&auto=format"
                     alt="Suivi logistique entrepôt" loading="lazy">
                <div class="pm-photo-overlay"></div>
                <div class="pm-label">
                    <div class="pm-tag">Traçabilité</div>
                    <div class="pm-title">Suivi en temps réel</div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════ CATALOGUE VRAIES BOISSONS ══════════════ --}}
<section class="catalog-section">
    <div class="catalog-inner">
        <div class="section-eyebrow">Catalogue complet</div>
        <h2 class="section-h2">Vos boissons, <em>en un coup d'œil.</em></h2>
        <p class="section-sub">Chaque produit en cave avec son stock, sa catégorie et son prix FCFA — mis à jour en temps réel.</p>

        <div class="cat-filters">
            <div class="cf-pill active">Tout ({{ \App\Models\Drink::count() }})</div>
            <div class="cf-pill">🍺 Bière ({{ \App\Models\Drink::where('categorie','Bière')->count() }})</div>
            <div class="cf-pill">🥤 Jus ({{ \App\Models\Drink::where('categorie','Jus')->count() }})</div>
            <div class="cf-pill">🍷 Vin ({{ \App\Models\Drink::where('categorie','Vin')->count() }})</div>
            <div class="cf-pill">💧 Eau ({{ \App\Models\Drink::where('categorie','Eau')->count() }})</div>
        </div>

        <div class="drinks-grid">
            @foreach(\App\Models\Drink::orderBy('categorie')->get() as $drink)
            <div class="drink-card">
                <div class="drink-img-wrap">
                    @if($drink->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($drink->image))
                        <img src="{{ asset('storage/'.$drink->image) }}"
                             alt="{{ $drink->nom }}" loading="lazy">
                    @else
                        {{-- Fallback par catégorie via Unsplash --}}
                        @php
                            $fallbacks = [
                                'Bière' => 'https://images.unsplash.com/photo-1608270586620-248524c67de9?w=300&q=70',
                                'Vin'   => 'https://images.unsplash.com/photo-1474722883778-792e7990302f?w=300&q=70',
                                'Jus'   => 'https://images.unsplash.com/photo-1581006852262-e4307cf6283a?w=300&q=70',
                                'Eau'   => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=300&q=70',
                            ];
                            $fb = $fallbacks[$drink->categorie] ?? $fallbacks['Jus'];
                        @endphp
                        <img src="{{ $fb }}" alt="{{ $drink->nom }}" loading="lazy">
                    @endif

                    @if($drink->quantite_stock <= 0)
                        <span class="drink-stock-badge badge-out">Rupture</span>
                    @elseif($drink->quantite_stock < 10)
                        <span class="drink-stock-badge badge-low">Stock bas</span>
                    @else
                        <span class="drink-stock-badge badge-ok">Disponible</span>
                    @endif
                </div>
                <div class="drink-info">
                    <div class="drink-cat-label cat-{{ strtolower($drink->categorie) }}">
                        {{ $drink->categorie }}
                    </div>
                    <div class="drink-name">{{ $drink->nom }}</div>
                    <div class="drink-footer">
                        <div class="drink-price">{{ number_format($drink->prix_unitaire, 0, ',', ' ') }} FCFA</div>
                        <div class="drink-qty">{{ $drink->quantite_stock }} unités</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════ FEATURES / MODULES ══════════════ --}}
<section class="features-section">
    <div class="features-inner">
        <div class="section-eyebrow">Ce que vous obtenez</div>
        <h2 class="section-h2">3 modules. <em>1 seule app.</em></h2>
        <div class="features-grid">
            <div class="feature-cell fc-gold">
                <div class="feature-num">Module 01</div>
                <div class="feature-icon">🍾</div>
                <div class="feature-title">Gestion des Boissons</div>
                <p class="feature-desc">
                    Ajoutez, modifiez et supprimez vos boissons avec photo.
                    Bière, Vin, Jus, Eau — toutes vos catégories gérées.
                    Alertes automatiques si le stock est faible.
                </p>
                <div class="feature-tag">DrinkController.php</div>
            </div>
            <div class="feature-cell fc-green">
                <div class="feature-num">Module 02</div>
                <div class="feature-icon">🛒</div>
                <div class="feature-title">Ventes & Panier</div>
                <p class="feature-desc">
                    Vente simple ou multi-produits via panier.
                    Stock décrémenté automatiquement après chaque vente.
                    Annulation avec restitution du stock grâce aux transactions DB.
                </p>
                <div class="feature-tag">SaleController.php</div>
            </div>
            <div class="feature-cell fc-blue">
                <div class="feature-num">Module 03</div>
                <div class="feature-icon">📊</div>
                <div class="feature-title">Tableau de Bord</div>
                <p class="feature-desc">
                    CA total, graphique Chart.js des 7 derniers jours,
                    meilleur jour de vente, 5 dernières transactions —
                    tout mis à jour en temps réel.
                </p>
                <div class="feature-tag">dashboard.blade.php</div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════ PHOTO + LISTE ══════════════ --}}
<section class="fullphoto-section">
    <div class="fp-inner">
        <div class="fp-photo-wrap">
            <img src="https://images.unsplash.com/photo-1594224457860-e44ff7373aa9?w=900&q=80&auto=format"
                 alt="Usine embouteillage automatisée" loading="lazy">
            <div class="fp-photo-gradient"></div>
            <div class="fp-stat-chip">
                <div class="fsc-icon">🏭</div>
                <div>
                    <div class="fsc-val">{{ number_format(\App\Models\Drink::sum('quantite_stock'), 0, ',', ' ') }}</div>
                    <div class="fsc-lbl">Unités en stock</div>
                </div>
            </div>
        </div>
        <div class="fp-content">
            <div class="section-eyebrow">Pourquoi choisir</div>
            <h2 class="section-h2">Simple.<br>Rapide.<br><em>Pour tous.</em></h2>
            <ul class="checklist">
                <li>
                    <div class="check-icon"><i class="bi bi-check2"></i></div>
                    <div><strong>Démarrez en 30 secondes</strong><br>
                    <span>Créez votre compte, connectez-vous. Interface opérationnelle immédiatement.</span></div>
                </li>
                <li>
                    <div class="check-icon"><i class="bi bi-check2"></i></div>
                    <div><strong>Données toujours exactes</strong><br>
                    <span>Transactions atomiques DB — zéro incohérence, zéro perte de données.</span></div>
                </li>
                <li>
                    <div class="check-icon"><i class="bi bi-check2"></i></div>
                    <div><strong>Sécurité Laravel Breeze</strong><br>
                    <span>Bcrypt, protection CSRF, middleware auth, rôles Admin / Client.</span></div>
                </li>
                <li>
                    <div class="check-icon"><i class="bi bi-check2"></i></div>
                    <div><strong>Vente multiple en 1 clic</strong><br>
                    <span>Panier multi-produits — vendez à un même client en une seule transaction.</span></div>
                </li>
                <li>
                    <div class="check-icon"><i class="bi bi-check2"></i></div>
                    <div><strong>Photos réelles de vos boissons</strong><br>
                    <span>Upload de photo pour chaque produit — votre cave prend vie visuellement.</span></div>
                </li>
            </ul>
        </div>
    </div>
</section>

{{-- ══════════════ CTA ══════════════ --}}
<section class="cta-section">
    <div class="cta-glow"></div>
    <div class="cta-inner">
        <div class="section-eyebrow" style="justify-content:center;margin-bottom:18px;">Prêt ?</div>
        <h2 class="cta-h2">
            Gérez votre cave<br>
            <span class="gradient-text">dès maintenant.</span>
        </h2>
        <p class="cta-p">
            Créez votre compte gratuitement et commencez à suivre votre stock
            de boissons en quelques secondes.
        </p>
        <div class="cta-btns">
            <a href="{{ route('register') }}" class="btn-hero-main">
                <i class="bi bi-person-plus-fill"></i>
                Créer mon compte
            </a>
            <a href="{{ route('login') }}" class="btn-hero-ghost">
                <i class="bi bi-box-arrow-in-right"></i>
                Se connecter
            </a>
        </div>
    </div>
</section>

{{-- ══════════════ FOOTER ══════════════ --}}
<footer class="footer-nv">
    <div class="footer-brand">Nisca<span>vor</span> Stock</div>
    <div class="footer-info">© {{ date('Y') }} Groupe 6 · UVBF · Laravel 11 · MySQL</div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Filter tabs (front uniquement, pas de rechargement)
    document.querySelectorAll('.cf-pill').forEach(pill => {
        pill.addEventListener('click', () => {
            document.querySelectorAll('.cf-pill').forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
        });
    });

    // Navbar opaque au scroll
    window.addEventListener('scroll', () => {
        const nav = document.querySelector('.navbar-nv');
        nav.style.background = window.scrollY > 60
            ? 'rgba(7,9,15,0.98)'
            : 'rgba(7,9,15,0.88)';
    });
</script>
</body>
</html>