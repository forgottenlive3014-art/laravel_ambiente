<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EcoMundo - Registro</title>
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
        padding: 40px 20px;
    }

    .auth-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        width: 100%;
        max-width: 550px;
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
    }

    .subtitle {
        text-align: center;
        color: #6b8c78;
        margin-bottom: 30px;
    }

    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 12px;
        border: 1.5px solid #c8e6d1;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #52b788;
        box-shadow: 0 0 0 3px rgba(82, 183, 136, 0.15);
    }

    .btn-success {
        background: #2d6a4f;
        border-radius: 50px;
        padding: 12px;
        font-weight: 700;
        width: 100%;
    }

    .btn-success:hover {
        background: #1a4731;
    }
</style>
</head>
<body>
<div class="auth-card">
    <div class="logo"><span>Eco</span>Mundo</div>
    <h3>Crea tu cuenta</h3>
    <p class="subtitle">Es gratis y solo toma un minuto</p>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Municipio</label>
            <select name="municipio" class="form-select" required>
                <option value="">Selecciona un municipio</option>
                @foreach($municipios as $depto => $lista)
                    <optgroup label="{{ $depto }}">
                        @foreach($lista as $municipio)
                            <option value="{{ $municipio }}" {{ old('municipio') == $municipio ? 'selected' : '' }}>
                                {{ $municipio }}
                            </option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
            <small class="text-muted">Mínimo 8 caracteres</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Registrarse</button>
    </form>
    <p class="text-center mt-3"><a href="{{ route('login') }}" style="color:#2d6a4f;">¿Ya tienes cuenta? Inicia sesión</a></p>
</div>
</body>
</html>