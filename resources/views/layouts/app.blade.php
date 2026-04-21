<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EcoMundo – @yield('title', 'Panel de Contenido Ambiental')</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --green-dark:   #1a4731;
            --green-mid:    #2d6a4f;
            --green-light:  #52b788;
            --green-pale:   #d8f3dc;
            --accent:       #74c69d;
            --text-dark:    #1b2d23;
            --text-mid:     #3a5a40;
            --text-light:   #f8fdf9;
            --white:        #ffffff;
            --shadow:       0 4px 24px rgba(0,0,0,0.10);
            --radius:       16px;
            --transition:   0.3s ease;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: #f0faf4;
            color: var(--text-dark);
            line-height: 1.7;
        }

        /* ===== NAVBAR ===== */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 5%;
            height: 68px;
            background: rgba(26, 71, 49, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
        }

        .nav-logo {
            display: flex; align-items: center; gap: 10px;
            font-size: 1.35rem; font-weight: 700;
            color: var(--text-light); text-decoration: none;
            letter-spacing: 0.5px;
        }
        .nav-logo span { color: var(--accent); }

        .nav-links {
            display: flex; gap: 10px; list-style: none; align-items: center;
        }
        .nav-links a {
            color: var(--text-light); text-decoration: none;
            padding: 8px 20px; border-radius: 50px;
            font-size: 0.95rem; font-weight: 500;
            transition: var(--transition);
        }
        .nav-links a:hover { background: rgba(255,255,255,0.12); }
        .nav-links a.btn-nav {
            background: var(--green-light); color: var(--green-dark); font-weight: 700;
        }
        .nav-links a.btn-nav:hover { background: var(--accent); }

        .user-badge {
            display: flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--text-light);
            padding: 6px 16px; border-radius: 50px;
            font-size: 0.88rem; font-weight: 600;
        }

        /* ===== HERO DASHBOARD ===== */
        .dash-hero {
            min-height: 340px;
            background:
                linear-gradient(to bottom, rgba(20,55,35,0.78) 0%, rgba(26,71,49,0.60) 60%, rgba(240,250,244,1) 100%),
                url('https://images.unsplash.com/photo-1448375240586-882707db888b?w=1600') center/cover no-repeat;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center;
            padding: 120px 5% 80px;
        }

        .dash-hero .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            color: #c8f5da;
            padding: 6px 16px; border-radius: 50px;
            font-size: 0.85rem; font-weight: 600;
            letter-spacing: 1px; text-transform: uppercase;
            margin-bottom: 20px;
            backdrop-filter: blur(6px);
        }

        .dash-hero h1 {
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 800; color: var(--white);
            line-height: 1.2; max-width: 700px;
            text-shadow: 0 2px 20px rgba(0,0,0,0.3);
            margin-bottom: 14px;
        }
        .dash-hero h1 em { font-style: normal; color: #74c69d; }

        .dash-hero p {
            font-size: 1.05rem; color: rgba(255,255,255,0.85);
            max-width: 560px;
        }

        /* ===== SEARCH BAR ===== */
        .search-wrap {
            max-width: 700px;
            margin: -28px auto 0;
            padding: 0 5%;
            position: relative; z-index: 10;
        }

        .search-box {
            display: flex; align-items: center;
            background: var(--white);
            border-radius: 50px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            overflow: hidden;
            padding: 6px 6px 6px 22px;
            gap: 10px;
        }

        .search-box span { font-size: 1.1rem; }

        .search-box input {
            flex: 1; border: none; outline: none;
            font-size: 1rem; color: var(--text-dark);
            background: transparent;
            padding: 8px 0;
        }

        .search-box button {
            background: var(--green-mid);
            color: var(--white);
            border: none; border-radius: 50px;
            padding: 11px 26px;
            font-size: 0.93rem; font-weight: 700;
            cursor: pointer; transition: var(--transition);
        }
        .search-box button:hover { background: var(--green-dark); }

        /* ===== CATEGORY PILLS ===== */
        .categories {
            max-width: 1200px;
            margin: 48px auto 0;
            padding: 0 5%;
        }

        .cat-title {
            font-size: 0.8rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            color: var(--text-mid); margin-bottom: 14px;
        }

        .cat-pills {
            display: flex; flex-wrap: wrap; gap: 10px;
        }

        .pill {
            padding: 8px 20px; border-radius: 50px;
            font-size: 0.88rem; font-weight: 600;
            cursor: pointer; transition: var(--transition);
            border: 2px solid transparent;
        }

        .pill.active, .pill:hover {
            background: var(--green-mid); color: var(--white);
        }
        .pill:not(.active) {
            background: var(--white);
            color: var(--text-mid);
            border-color: #c8e6d1;
        }

        /* ===== FEATURED ARTICLE ===== */
        .section-wrap {
            max-width: 1200px;
            margin: 52px auto 0;
            padding: 0 5%;
        }

        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 28px;
        }

        .section-header h2 {
            font-size: 1.4rem; font-weight: 800; color: var(--green-dark);
        }

        .section-header a {
            font-size: 0.88rem; font-weight: 600;
            color: var(--green-mid); text-decoration: none;
        }
        .section-header a:hover { text-decoration: underline; }

        .featured-card {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            background: var(--white);
            transition: var(--transition);
        }
        .featured-card:hover { transform: translateY(-4px); box-shadow: 0 12px 40px rgba(0,0,0,0.14); }

        .featured-img {
            background: url('https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=800') center/cover no-repeat;
            min-height: 320px;
        }

        .featured-body {
            padding: 44px 40px;
            display: flex; flex-direction: column; justify-content: center;
        }

        .tag {
            display: inline-block;
            background: var(--green-pale);
            color: var(--green-mid);
            padding: 4px 14px; border-radius: 50px;
            font-size: 0.78rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.8px;
            margin-bottom: 16px;
        }

        .featured-body h3 {
            font-size: 1.6rem; font-weight: 800;
            color: var(--green-dark); line-height: 1.3;
            margin-bottom: 14px;
        }

        .featured-body p {
            color: var(--text-mid); font-size: 0.97rem;
            margin-bottom: 24px;
        }

        .meta {
            display: flex; align-items: center; gap: 16px;
            font-size: 0.82rem; color: #8aac95;
            margin-bottom: 24px;
        }
        .meta span { display: flex; align-items: center; gap: 5px; }

        .btn-read {
            display: inline-block;
            background: var(--green-mid);
            color: var(--white);
            padding: 12px 28px; border-radius: 50px;
            font-size: 0.93rem; font-weight: 700;
            text-decoration: none; border: none; cursor: pointer;
            transition: var(--transition);
            align-self: flex-start;
        }
        .btn-read:hover { background: var(--green-dark); transform: translateY(-2px); }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .article-card {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            display: flex; flex-direction: column;
        }
        .article-card:hover { transform: translateY(-4px); box-shadow: 0 12px 36px rgba(0,0,0,0.13); }

        .article-img {
            height: 190px;
            background-size: cover;
            background-position: center;
        }

        .article-body {
            padding: 22px 22px 28px;
            display: flex; flex-direction: column; flex: 1;
        }

        .article-body h4 {
            font-size: 1.05rem; font-weight: 800;
            color: var(--green-dark); line-height: 1.35;
            margin: 10px 0 10px;
        }

        .article-body p {
            font-size: 0.88rem; color: var(--text-mid);
            flex: 1; margin-bottom: 18px;
        }

        .article-footer {
            display: flex; align-items: center; justify-content: space-between;
            font-size: 0.8rem; color: #8aac95;
            border-top: 1px solid #e8f5ec;
            padding-top: 14px; margin-top: auto;
        }

        .stats-section {
            background: linear-gradient(135deg, var(--green-dark) 0%, var(--green-mid) 100%);
            margin: 64px 0 0;
            padding: 72px 5%;
        }

        .stats-section .inner {
            max-width: 1200px; margin: 0 auto;
        }

        .stats-section h2 {
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 800; color: var(--white);
            max-width: 500px; line-height: 1.3;
            margin-bottom: 48px;
        }

        .data-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .data-card {
            background: rgba(255,255,255,0.10);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: var(--radius);
            padding: 28px 24px;
            text-align: center;
            transition: var(--transition);
        }
        .data-card:hover { background: rgba(255,255,255,0.17); transform: translateY(-4px); }

        .data-card .icon { font-size: 2.4rem; margin-bottom: 14px; display: block; }
        .data-card .number {
            font-size: 2rem; font-weight: 800; color: var(--accent);
            display: block; margin-bottom: 6px;
        }
        .data-card .label { font-size: 0.88rem; color: rgba(255,255,255,0.75); font-weight: 500; }
        .data-card .trend {
            font-size: 0.78rem; margin-top: 8px;
            display: inline-block;
            background: rgba(231,76,60,0.2);
            color: #ff8a80;
            padding: 3px 10px; border-radius: 50px;
            font-weight: 600;
        }
        .data-card .trend.good {
            background: rgba(82,183,136,0.2); color: #80cfa9;
        }

        .tips-section {
            max-width: 1200px; margin: 64px auto 0; padding: 0 5%;
        }

        .tips-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 24px;
        }

        .tip-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 28px 28px;
            box-shadow: var(--shadow);
            display: flex; gap: 18px; align-items: flex-start;
            border-left: 5px solid var(--green-light);
            transition: var(--transition);
        }
        .tip-card:hover { transform: translateX(4px); }

        .tip-icon {
            width: 52px; height: 52px; border-radius: 14px;
            background: var(--green-pale);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; flex-shrink: 0;
        }

        .tip-content h4 {
            font-size: 1rem; font-weight: 700;
            color: var(--green-dark); margin-bottom: 6px;
        }
        .tip-content p { font-size: 0.88rem; color: var(--text-mid); }

        .cta-banner {
            max-width: 1200px; margin: 64px auto; padding: 0 5%;
        }

        .cta-inner {
            background: linear-gradient(to right, rgba(26,71,49,0.9), rgba(45,106,79,0.85)),
                        url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=1200') center/cover no-repeat;
            border-radius: calc(var(--radius) * 1.5);
            padding: 60px 64px;
            display: flex; align-items: center; justify-content: space-between;
            gap: 40px; flex-wrap: wrap;
        }

        .cta-text h3 {
            font-size: clamp(1.4rem, 2.5vw, 2rem);
            font-weight: 800; color: var(--white);
            margin-bottom: 10px;
        }
        .cta-text p { color: rgba(255,255,255,0.8); font-size: 1rem; max-width: 440px; }

        .cta-actions { display: flex; gap: 12px; flex-wrap: wrap; }

        .btn-white {
            background: var(--white); color: var(--green-dark);
            padding: 13px 30px; border-radius: 50px;
            font-size: 0.97rem; font-weight: 700;
            text-decoration: none; transition: var(--transition);
            display: inline-block;
        }
        .btn-white:hover { background: var(--green-pale); transform: translateY(-2px); }

        .btn-ghost {
            background: transparent; color: var(--white);
            padding: 13px 30px; border-radius: 50px;
            font-size: 0.97rem; font-weight: 700;
            text-decoration: none; border: 2px solid rgba(255,255,255,0.5);
            transition: var(--transition); display: inline-block;
        }
        .btn-ghost:hover { border-color: var(--white); background: rgba(255,255,255,0.1); }

        footer {
            background: var(--green-dark);
            color: rgba(255,255,255,0.7);
            text-align: center;
            padding: 28px 5%;
            font-size: 0.88rem;
        }
        footer strong { color: var(--accent); }

        .section-label {
            display: inline-block;
            background: var(--green-pale);
            color: var(--green-mid);
            padding: 4px 16px; border-radius: 50px;
            font-size: 0.8rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: 1px;
            margin-bottom: 14px;
        }

        @media (max-width: 900px) {
            .articles-grid { grid-template-columns: 1fr 1fr; }
            .data-grid { grid-template-columns: 1fr 1fr; }
            .featured-card { grid-template-columns: 1fr; }
            .featured-img { min-height: 220px; }
        }
        @media (max-width: 640px) {
            .articles-grid { grid-template-columns: 1fr; }
            .data-grid { grid-template-columns: 1fr 1fr; }
            .tips-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .cta-inner { padding: 36px 28px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<nav>
    <a href="{{ route('dashboard') }}" class="nav-logo">🌿 <span>Eco</span>Mundo</a>
    <ul class="nav-links">
        <li><a href="#articulos">Artículos</a></li>
        <li><a href="#datos">Datos</a></li>
        <li><a href="#consejos">Consejos</a></li>
        @auth
            <li><div class="user-badge">👤 {{ Auth::user()->name }}</div></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: white; cursor: pointer; padding: 8px 20px;">🚪 Salir</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}" class="btn-nav">Iniciar sesión</a></li>
            <li><a href="{{ route('register') }}" class="btn-nav">Registrarse</a></li>
        @endauth
    </ul>
</nav>

<main>
    @yield('content')
</main>

<footer>
    <p>🌿 <strong>EcoMundo</strong> · Juntos por un planeta más verde · {{ date('Y') }}</p>
    <p style="margin-top:6px; font-size:0.8rem">Hecho con 💚 para quienes aman la Tierra</p>
</footer>

<script>
    document.querySelectorAll('.pill').forEach(pill => {
        pill.addEventListener('click', () => {
            document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
            pill.classList.add('active');
        });
    });

    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', e => {
            const target = document.querySelector(link.getAttribute('href'));
            if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
        });
    });
</script>
@stack('scripts')
</body>
</html>