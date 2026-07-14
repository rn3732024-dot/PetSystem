<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | {{ config('app.name', 'Pet System') }}</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; font-family: Arial, Helvetica, sans-serif; background: #f8f8fb; color: #111827; }
        .login-page { min-height: 100vh; display: grid; grid-template-columns: minmax(240px, 36%) 1fr; }
        .brand-panel { background: #c8c6ff; display: flex; align-items: center; justify-content: center; padding: 3rem 2rem; }
        .brand { text-align: center; color: #090b18; }
        .brand-icon { font-size: clamp(6rem, 13vw, 10rem); line-height: 1; filter: grayscale(1) contrast(1.5); }
        .brand h1 { margin: .5rem 0 0; font-size: clamp(2rem, 4vw, 3rem); font-weight: 800; letter-spacing: -1.5px; }
        .brand h1 span { color: #4f46e5; }
        .form-panel { display: flex; align-items: center; justify-content: center; padding: 2rem; background: rgba(255, 255, 255, .95); }
        .login-card { width: min(100%, 430px); }
        .login-card h2 { margin: 0 0 2.6rem; text-align: center; color: #b7b5ff; font-size: 2rem; font-weight: 800; letter-spacing: .5px; }
        .field { display: grid; grid-template-columns: 120px 1fr; gap: 1rem; align-items: center; margin: 1.05rem 0; }
        .field label { color: #b7b5ff; font-weight: 800; font-size: 1rem; text-transform: uppercase; }
        .field input, .field select { width: 100%; height: 38px; padding: .45rem .65rem; border: 1px solid #9ca3af; border-radius: 2px; background: #fff; color: #111827; font-size: 1rem; }
        .field input:focus, .field select:focus { outline: 2px solid #818cf8; outline-offset: 1px; border-color: #6366f1; }
        .field input::placeholder { color: #9ca3af; }
        .actions { display: flex; justify-content: center; gap: 2.4rem; margin-top: 2.2rem; }
        .button { min-width: 94px; padding: .52rem 1rem; border: 1px solid #6b7280; border-radius: 5px; background: #fff; color: #111827; font-weight: 700; font-size: .95rem; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,.1); }
        .button:hover { background: #eef2ff; border-color: #4f46e5; }
        .signup { display: block; width: max-content; margin: 1.25rem auto 0; color: #a5a3ff; font-size: .9rem; text-decoration: none; }
        .signup:hover { color: #4f46e5; text-decoration: underline; }
        .message, .error { grid-column: 2; margin: -.45rem 0 .2rem; font-size: .82rem; }
        .message { color: #047857; } .error { color: #b91c1c; }
        @media (max-width: 640px) {
            .login-page { grid-template-columns: 1fr; }
            .brand-panel { min-height: 220px; padding: 2rem; }
            .brand-icon { font-size: 6rem; }
            .form-panel { align-items: flex-start; padding: 3rem 1.5rem; }
            .field { grid-template-columns: 1fr; gap: .35rem; }
            .message, .error { grid-column: 1; margin: 0; }
        }
    </style>
</head>
<body>
    <main class="login-page">
        <aside class="brand-panel">
            <div class="brand">
                <div class="brand-icon" aria-hidden="true">🐱</div>
                <h1>Pets<span>Care</span></h1>
            </div>
        </aside>

        <section class="form-panel">
            <div class="login-card">
                <h2>LOGIN</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    @if (session('status'))
                        <p class="message">{{ session('status') }}</p>
                    @endif

                    <div class="field">
                        <label for="email">Username</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Email address" required autofocus autocomplete="username">
                        @error('email')<p class="error">{{ $message }}</p>@enderror
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password">
                        @error('password')<p class="error">{{ $message }}</p>@enderror
                    </div>

                    <div class="field">
                        <label for="login_as">Login as</label>
                        <select id="login_as" name="login_as">
                            <option value="admin">Administrator</option>
                        </select>
                    </div>

                    <div class="actions">
                        <button class="button" type="submit">Login</button>
                        <button class="button" type="reset">Clear</button>
                    </div>

                    @if (Route::has('register'))
                        <a class="signup" href="{{ route('register') }}">SIGN UP</a>
                    @endif
                </form>
            </div>
        </section>
    </main>
</body>
</html>
