<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EcoMundo – Iniciar Sesión</title>
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
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #1a4731 0%, #2d6a4f 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            max-width: 460px;
            width: 100%;
        }

        .auth-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 44px 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }

        .logo {
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            color: var(--green-dark);
            margin-bottom: 10px;
        }

        .logo span { color: var(--green-light); }

        .auth-card h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--green-dark);
            margin-bottom: 6px;
            text-align: center;
        }

        .subtitle {
            text-align: center;
            font-size: 0.9rem;
            color: #6b8c78;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--text-mid);
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            color: #8aac95;
        }

        .form-group input {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 1.5px solid #c8e6d1;
            border-radius: 10px;
            font-size: 0.97rem;
            background: #f7fdf9;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group input:focus {
            border-color: var(--green-light);
            box-shadow: 0 0 0 3px rgba(82,183,136,0.15);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .checkbox-group input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--green-light);
        }

        .checkbox-group label {
            font-size: 0.88rem;
            color: var(--text-mid);
            cursor: pointer;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            border-radius: 50px;
            border: none;
            background: var(--green-mid);
            color: var(--white);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: var(--green-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(45,106,79,0.4);
        }

        .auth-switch {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #6b8c78;
        }

        .auth-switch a {
            color: var(--green-mid);
            font-weight: 700;
            text-decoration: none;
        }

        .auth-switch a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.88rem;
        }

        .alert-danger {
            background: #fee2e2;
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }

        .error-msg {
            font-size: 0.8rem;
            color: #e63946;
            margin-top: 5px;
            display: none;
        }

        .error-msg.visible {
            display: block;
        }

        input.error {
            border-color: #e63946;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="logo">🌿 <span>Eco</span>Mundo</div>
        <div class="auth-card">
            <h3>¡Bienvenido de nuevo! 👋</h3>
            <p class="subtitle">Ingresa tus datos para continuar</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="form-group">
                    <label>Correo electrónico</label>
                    <div class="input-wrapper">
                        <span class="input-icon">📧</span>
                        <input type="email" name="email" id="email" value="{{ old('email', $email ?? '') }}" required>
                    </div>
                    <span class="error-msg" id="emailError">Por favor ingresa un correo válido.</span>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <span class="error-msg" id="passwordError">La contraseña es requerida.</span>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Recordar mi sesión</label>
                </div>

                <button type="submit" class="btn-submit">Iniciar sesión 🌿</button>
            </form>

            <p class="auth-switch">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate gratis</a></p>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            let valid = true;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                document.getElementById('emailError').classList.add('visible');
                document.getElementById('email').classList.add('error');
                valid = false;
            } else {
                document.getElementById('emailError').classList.remove('visible');
                document.getElementById('email').classList.remove('error');
            }

            if (password.length === 0) {
                document.getElementById('passwordError').classList.add('visible');
                document.getElementById('password').classList.add('error');
                valid = false;
            } else {
                document.getElementById('passwordError').classList.remove('visible');
                document.getElementById('password').classList.remove('error');
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>