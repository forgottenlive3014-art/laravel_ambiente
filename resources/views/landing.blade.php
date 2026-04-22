<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>EcoMundo – Cuida el planeta, cuida tu futuro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --green-dark: #1a4731;
            --green-mid: #2d6a4f;
            --green-light: #52b788;
            --green-pale: #d8f3dc;
            --accent: #74c69d;
            --text-dark: #1b2d23;
            --text-mid: #3a5a40;
            --white: #ffffff;
            --shadow: 0 4px 24px rgba(0,0,0,0.10);
            --radius: 16px;
            --transition: 0.3s ease;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: #f0faf4;
            color: var(--text-dark);
            line-height: 1.7;
        }

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
        }
        .nav-logo span { color: var(--accent); }

        .nav-links {
            display: flex; gap: 10px; list-style: none;
        }
        .nav-links a {
            color: var(--text-light); text-decoration: none;
            padding: 8px 20px; border-radius: 50px;
            font-size: 0.95rem; font-weight: 500;
            transition: var(--transition);
        }
        .nav-links a:hover { background: rgba(255,255,255,0.12); }
        .nav-links a.btn-nav {
            background: var(--green-light);
            color: var(--green-dark);
            font-weight: 700;
        }

        #hero {
            min-height: 100vh;
            background: linear-gradient(to bottom, rgba(20,55,35,0.72) 0%, rgba(26,71,49,0.55) 60%, rgba(240,250,244,1) 100%),
                        url('https://images.unsplash.com/photo-1448375240586-882707db888b?w=1600') center/cover no-repeat;
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            text-align: center;
            padding: 120px 5% 80px;
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            color: #c8f5da;
            padding: 6px 16px; border-radius: 50px;
            font-size: 0.85rem;
            margin-bottom: 24px;
        }

        .hero-badge::before { content: '🌿'; }

        #hero h1 {
            font-size: clamp(2rem, 5vw, 3.8rem);
            font-weight: 800;
            color: var(--white);
            max-width: 780px;
            margin-bottom: 20px;
        }

        #hero h1 em { font-style: normal; color: #74c69d; }

        #hero p {
            font-size: clamp(1rem, 2vw, 1.2rem);
            color: rgba(255,255,255,0.88);
            max-width: 600px;
            margin-bottom: 40px;
        }

        .hero-cta {
            display: flex; gap: 14px; flex-wrap: wrap; justify-content: center;
        }

        .btn {
            padding: 14px 32px;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
        }

        .btn-primary {
            background: var(--green-light);
            color: var(--green-dark);
            box-shadow: 0 4px 20px rgba(82,183,136,0.4);
        }
        .btn-primary:hover {
            background: var(--accent);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: var(--white);
            border: 2px solid rgba(255,255,255,0.55);
        }
        .btn-outline:hover {
            background: rgba(255,255,255,0.12);
            border-color: var(--white);
        }

        .stats-bar {
            background: var(--white);
            border-radius: var(--radius);
            padding: 28px 40px;
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 860px;
            margin: -40px auto 0;
            box-shadow: var(--shadow);
            position: relative;
            z-index: 10;
        }

        .stat-item {
            text-align: center;
            padding: 10px 24px;
            border-right: 1px solid #e5f0ea;
            flex: 1;
        }
        .stat-item:last-child { border-right: none; }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--green-mid);
        }
        .stat-label {
            font-size: 0.85rem;
            color: var(--text-mid);
        }

        #about {
            padding: 100px 5% 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-label {
            display: inline-block;
            background: var(--green-pale);
            color: var(--green-mid);
            padding: 4px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        #about h2 {
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 800;
            color: var(--green-dark);
            max-width: 520px;
            margin-bottom: 16px;
        }

        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .about-text p {
            color: var(--text-mid);
            font-size: 1.05rem;
            margin-bottom: 16px;
        }

        .feature-list {
            list-style: none;
            margin-top: 28px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .feature-icon {
            width: 36px;
            height: 36px;
            background: var(--green-pale);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        .about-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .about-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 28px 22px;
            box-shadow: var(--shadow);
            border-top: 4px solid var(--green-light);
            transition: var(--transition);
        }
        .about-card:hover { transform: translateY(-4px); }

        .about-card .icon { font-size: 2rem; margin-bottom: 12px; display: block; }
        .about-card h3 { font-size: 1rem; font-weight: 700; color: var(--green-dark); margin-bottom: 6px; }
        .about-card p { font-size: 0.88rem; color: var(--text-mid); }

        footer {
            background: var(--green-dark);
            color: rgba(255,255,255,0.7);
            text-align: center;
            padding: 28px 5%;
        }
        footer strong { color: var(--accent); }

        @media (max-width: 768px) {
            .about-grid { grid-template-columns: 1fr; gap: 40px; }
            .about-cards { grid-template-columns: 1fr; }
            .stats-bar { padding: 20px; }
            .stat-item { border-right: none; border-bottom: 1px solid #e5f0ea; padding: 12px; }
            .stat-item:last-child { border-bottom: none; }
            .nav-links { display: none; }
        }
    </style>
</head>
<body>

<nav>
    <a href="{{ url('/landing') }}" class="nav-logo">🌿 <span>Eco</span>Mundo</a>
    <ul class="nav-links">
        <li><a href="#about">Nosotros</a></li>
        <li><a href="#auth">Comunidad</a></li>
        <li><a href="{{ route('register') }}" class="btn-nav">Únete gratis</a></li>
    </ul>
</nav>

<section id="hero">
    <div class="hero-badge">Plataforma ecológica</div>
    <h1>Cuida el planeta,<br/><em>cuida tu futuro</em></h1>
    <p>EcoMundo es la comunidad digital donde el conocimiento y la acción se unen para proteger nuestro medioambiente. Aprende, comparte y actúa.</p>
    <div class="hero-cta">
        <a href="{{ route('register') }}" class="btn btn-primary">Únete a la comunidad</a>
        <a href="#about" class="btn btn-outline">Conoce más</a>
    </div>
</section>

<div class="stats-bar">
    <div class="stat-item"><span class="stat-number">+12K</span><span class="stat-label">Miembros activos</span></div>
    <div class="stat-item"><span class="stat-number">340+</span><span class="stat-label">Artículos ecológicos</span></div>
    <div class="stat-item"><span class="stat-number">80+</span><span class="stat-label">Países representados</span></div>
    <div class="stat-item"><span class="stat-number">100%</span><span class="stat-label">Compromiso verde</span></div>
</div>

<section id="about">
    <div class="about-grid">
        <div class="about-text">
            <span class="section-label">¿Qué es EcoMundo?</span>
            <h2>Un espacio para quienes aman la Tierra</h2>
            <p>EcoMundo nació con una misión simple pero poderosa: conectar a personas que quieren hacer una diferencia real en el medioambiente.</p>
            <p>Aquí encontrarás recursos educativos, noticias ambientales, guías prácticas y una comunidad activa que comparte tu mismo compromiso con el planeta.</p>
            <ul class="feature-list">
                <li><div class="feature-icon">🌱</div><div><strong>Aprende:</strong> Accede a contenido educativo sobre ecología, cambio climático y sostenibilidad.</div></li>
                <li><div class="feature-icon">🤝</div><div><strong>Conecta:</strong> Únete a una comunidad activa de personas apasionadas por el planeta.</div></li>
                <li><div class="feature-icon">⚡</div><div><strong>Actúa:</strong> Descubre iniciativas locales y globales en las que puedes participar hoy.</div></li>
            </ul>
        </div>
        <div class="about-cards">
            <div class="about-card"><span class="icon">🌍</span><h3>Cambio Climático</h3><p>Información actualizada sobre el estado del planeta y qué podemos hacer.</p></div>
            <div class="about-card"><span class="icon">♻️</span><h3>Vida Sostenible</h3><p>Guías prácticas para reducir tu huella ecológica día a día.</p></div>
            <div class="about-card"><span class="icon">🐾</span><h3>Biodiversidad</h3><p>Conoce y protege las especies y ecosistemas más vulnerables.</p></div>
            <div class="about-card"><span class="icon">💧</span><h3>Agua & Océanos</h3><p>El agua es vida. Aprende a conservar este recurso esencial.</p></div>
        </div>
    </div>
</section>

<footer>
    <p>🌿 <strong>EcoMundo</strong> · Juntos por un planeta más verde · {{ date('Y') }}</p>
    <p style="margin-top:6px; font-size:0.8rem">Hecho con 💚 para quienes aman la Tierra</p>
</footer>

<script>
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', e => {
            const target = document.querySelector(link.getAttribute('href'));
            if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
        });
    });
</script>
</body>
</html>