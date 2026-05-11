<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EcoMundo - Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to top, rgba(20, 55, 35, 0.78) 0%, rgba(26, 71, 49, 0.60) 60%, rgba(230, 240, 234, 1) 150%),
                    url('https://cdn.pixabay.com/photo/2024/04/20/11/47/ai-generated-8708404_1280.jpg') center/cover no-repeat;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .auth-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .logo {
        text-align: center;
        font-size: 2rem;
        font-weight: 800;
        color: #1a4731;
        margin-bottom: 10px;
    }

    .logo span {
        color: #52b788;
    }

    h3 {
        text-align: center;
        font-weight: 800;
        color: #1a4731;
        margin-bottom: 5px;
    }

    .subtitle {
        text-align: center;
        color: #6b8c78;
        margin-bottom: 30px;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px;
        border: 1.5px solid #c8e6d1;
    }

    .form-control:focus {
        border-color: #52b788;
        box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.15);
    }

    .btn-success {
        background: #2d6a4f;
        border: none;
        border-radius: 50px;
        padding: 12px;
        font-weight: 700;
        width: 100%;
    }

    .btn-success:hover {
        background: #1a4731;
    }

    .alert {
        border-radius: 10px;
    }
</style>
</head>
<body>
<div class="auth-card">
    <div class="logo"><span>Eco</span>Mundo</div>
    <h3>¡Bienvenido de nuevo! </h3>
    <p class="subtitle">Ingresa tus datos para continuar</p>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $email ?? '') }}" required autofocus>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label for="remember" class="form-check-label">Recordarme</label>
        </div>
        <button type="submit" class="btn btn-success">Iniciar sesión</button>
    </form>
    <p class="text-center mt-3"><a href="{{ route('register') }}" style="color:#2d6a4f;">¿No tienes cuenta? Regístrate</a></p>
</div>
</body>
</html>