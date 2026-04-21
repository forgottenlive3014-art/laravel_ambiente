<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EcoMundo – Crear Cuenta</title>
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
            background:
                linear-gradient(to top, rgba(20,55,35,0.78) 0%, rgba(26,71,49,0.60) 60%, rgba(230,240,234,1) 150%),
                url('https://cdn.pixabay.com/photo/2014/04/05/11/20/grass-315184_1280.jpg') center/cover no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .auth-container {
            max-width: 520px;
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

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 1.5px solid #c8e6d1;
            border-radius: 10px;
            font-size: 0.97rem;
            background: #f7fdf9;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--green-light);
            box-shadow: 0 0 0 3px rgba(82,183,136,0.15);
        }

        .strength-bar {
            height: 4px;
            border-radius: 4px;
            background: #e5f0ea;
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .strength-label {
            font-size: 0.75rem;
            margin-top: 4px;
            color: #8aac95;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        .checkbox-group input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            cursor: pointer;
            accent-color: var(--green-light);
        }

        .checkbox-group label {
            font-size: 0.88rem;
            color: var(--text-mid);
            cursor: pointer;
        }

        .checkbox-group label a {
            color: var(--green-mid);
            font-weight: 600;
            text-decoration: none;
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

        .error-msg {
            font-size: 0.8rem;
            color: #e63946;
            margin-top: 5px;
            display: none;
        }

        .error-msg.visible {
            display: block;
        }

        input.error, select.error {
            border-color: #e63946;
        }

        @media (max-width: 640px) {
            .auth-card { padding: 32px 22px; }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="logo">🌿 <span>Eco</span>Mundo</div>
        <div class="auth-card">
            <h3>Crea tu cuenta 🌱</h3>
            <p class="subtitle">Es gratis y solo toma un minuto</p>

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <div class="form-group">
                    <label>Nombre completo</label>
                    <div class="input-wrapper">
                        <span class="input-icon">👤</span>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                    </div>
                    <span class="error-msg" id="nameError">Por favor ingresa tu nombre.</span>
                </div>

                <div class="form-group">
                    <label>Correo electrónico</label>
                    <div class="input-wrapper">
                        <span class="input-icon">📧</span>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    </div>
                    <span class="error-msg" id="emailError">Ingresa un correo electrónico válido.</span>
                </div>

                <div class="form-group">
                    <label>Municipio de residencia</label>
                    <div class="input-wrapper">
                        <span class="input-icon">📍</span>
                        <select name="municipio" id="municipio" required>
                            <option value="">Selecciona un municipio</option>
                            @foreach($municipios as $depto => $municipiosLista)
                                <optgroup label="{{ $depto }}">
                                    @foreach($municipiosLista as $municipio)
                                        <option value="{{ $municipio }}" {{ old('municipio') == $municipio ? 'selected' : '' }}>
                                            {{ $municipio }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <span class="error-msg" id="municipioError">Selecciona un municipio.</span>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔒</span>
                        <input type="password" name="password" id="password" oninput="checkStrength(this.value)" required>
                    </div>
                    <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                    <span class="strength-label" id="strengthLabel">Escribe tu contraseña</span>
                    <span class="error-msg" id="passwordError">La contraseña debe tener al menos 8 caracteres.</span>
                </div>

                <div class="form-group">
                    <label>Confirmar contraseña</label>
                    <div class="input-wrapper">
                        <span class="input-icon">🔑</span>
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>
                    <span class="error-msg" id="confirmError">Las contraseñas no coinciden.</span>
                </div>

                <button type="submit" class="btn-submit">Crear cuenta gratis 🌍</button>
            </form>

            <p class="auth-switch">¿Ya tienes cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
        </div>
    </div>

    <script>
        function checkStrength(val) {
            const fill = document.getElementById('strengthFill');
            const label = document.getElementById('strengthLabel');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const levels = [
                { pct: '0%', color: '#e5f0ea', text: 'Escribe tu contraseña' },
                { pct: '25%', color: '#e63946', text: 'Muy débil' },
                { pct: '50%', color: '#f4a261', text: 'Débil' },
                { pct: '75%', color: '#74c69d', text: 'Buena' },
                { pct: '100%', color: '#2d6a4f', text: 'Muy segura 🔒' },
            ];
            const lvl = val.length === 0 ? levels[0] : levels[score];
            fill.style.width = lvl.pct;
            fill.style.backgroundColor = lvl.color;
            label.textContent = lvl.text;
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const municipio = document.getElementById('municipio').value;
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            let valid = true;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (name.length < 2) {
                document.getElementById('nameError').classList.add('visible');
                document.getElementById('name').classList.add('error');
                valid = false;
            } else {
                document.getElementById('nameError').classList.remove('visible');
                document.getElementById('name').classList.remove('error');
            }

            if (!emailRegex.test(email)) {
                document.getElementById('emailError').classList.add('visible');
                document.getElementById('email').classList.add('error');
                valid = false;
            } else {
                document.getElementById('emailError').classList.remove('visible');
                document.getElementById('email').classList.remove('error');
            }

            if (!municipio) {
                document.getElementById('municipioError').classList.add('visible');
                document.getElementById('municipio').classList.add('error');
                valid = false;
            } else {
                document.getElementById('municipioError').classList.remove('visible');
                document.getElementById('municipio').classList.remove('error');
            }

            if (password.length < 8) {
                document.getElementById('passwordError').classList.add('visible');
                document.getElementById('password').classList.add('error');
                valid = false;
            } else {
                document.getElementById('passwordError').classList.remove('visible');
                document.getElementById('password').classList.remove('error');
            }

            if (password !== confirm) {
                document.getElementById('confirmError').classList.add('visible');
                document.getElementById('password_confirmation').classList.add('error');
                valid = false;
            } else {
                document.getElementById('confirmError').classList.remove('visible');
                document.getElementById('password_confirmation').classList.remove('error');
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>