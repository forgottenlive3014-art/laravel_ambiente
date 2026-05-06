<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> EcoMundo - @yield('title', 'Ambiente El Salvador')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: #f0faf4; }
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 5%; height: 68px;
            background: rgba(26, 71, 49, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
        }
        .nav-logo { display: flex; align-items: center; gap: 10px; font-size: 1.35rem; font-weight: 700; color: white; text-decoration: none; }
        .nav-logo span { color: #74c69d; }
        .nav-links { display: flex; gap: 10px; list-style: none; align-items: center; }
        .nav-links a { color: white; text-decoration: none; padding: 8px 20px; border-radius: 50px; font-size: 0.95rem; transition: 0.3s; }
        .nav-links a:hover { background: rgba(255,255,255,0.12); }
        .nav-links a.btn-nav { background: #52b788; color: #1a4731; font-weight: 700; }
        .user-badge {
            display: flex; align-items: center; gap: 8px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            padding: 6px 16px; border-radius: 50px;
            font-size: 0.88rem;
        }
        footer {
            background: #1a4731;
            color: rgba(255,255,255,0.7);
            text-align: center;
            padding: 28px 5%;
            margin-top: 60px;
        }
        footer strong { color: #74c69d; }
        main { padding-top: 68px; }
        @media (max-width: 640px) { .nav-links { display: none; } }
    </style>
    @stack('styles')
</head>
<body>
<nav>
    <a href="{{ route('dashboard') }}" class="nav-logo">🌿 <span>Eco</span>Mundo</a>
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}">Inicio</a></li>
        @auth
    @if(Auth::user()->role === 'admin')
        <li><a href="{{ route('admin.environmental.index') }}"> Datos Ambientales</a></li>
        <li><a href="{{ route('admin.users.index') }}"> Usuarios</a></li>
    @endif
    <li><div class="user-badge"> {{ Auth::user()->name }}</div></li>
    <li>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" style="background:none; border:none; color:white; cursor:pointer; padding:8px 20px;"> Cerrar Sesión</button>
        </form>
    </li>
@else
    <li><a href="{{ route('login') }}" class="btn-nav">Iniciar sesión</a></li>
    <li><a href="{{ route('register') }}" class="btn-nav">Registrarse</a></li>
@endauth
    </ul>
</nav>
<main>
    @if(session('success'))
        <div class="alert alert-success m-3">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger m-3">{{ session('error') }}</div>
    @endif
    @yield('content')
</main>
<footer>
    <p> <strong>EcoMundo</strong> · Juntos por un planeta más verde · {{ date('Y') }}</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>