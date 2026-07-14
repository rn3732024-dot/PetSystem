<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Pet System') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .pet-background {
            background:
                radial-gradient(circle at top left, rgba(129, 140, 248, .48), transparent 34%),
                linear-gradient(135deg, #e0e7ff 0%, #dbeafe 48%, #fef3c7 100%);
        }
        .pet-pattern { position: fixed; inset: 0; overflow: hidden; pointer-events: none; z-index: 0; }
        .pet-pattern span { position: absolute; opacity: .18; filter: saturate(.8); }
        .pet-pattern .paw { font-size: 4.5rem; }
        .pet-pattern .pet { font-size: 5.5rem; }
        .content-layer { position: relative; z-index: 1; }
        .readable-panel { background: rgba(255, 255, 255, .88); backdrop-filter: blur(8px); }
    </style>
</head>
<body class="pet-background min-h-screen font-sans text-slate-900">
    <div class="pet-pattern" aria-hidden="true">
        <span class="paw" style="top: 10%; left: 6%; transform: rotate(-24deg);">🐾</span>
        <span class="pet" style="top: 12%; right: 8%; transform: rotate(10deg);">🐶</span>
        <span class="paw" style="top: 43%; right: 20%; transform: rotate(26deg);">🐾</span>
        <span class="pet" style="bottom: 8%; left: 7%; transform: rotate(-8deg);">🐱</span>
        <span class="paw" style="bottom: 12%; right: 7%; transform: rotate(-18deg);">🐾</span>
        <span class="pet" style="bottom: 34%; left: 42%; transform: rotate(12deg);">🐰</span>
    </div>

    <header class="content-layer border-b border-indigo-100 bg-white/85 backdrop-blur-sm">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-700">Pet System</a>
            @auth
                <a href="{{ auth()->user()->is_admin ? route('dashboard') : route('profile.edit') }}" style="background-color: #4f46e5; color: #ffffff;" class="rounded-lg px-4 py-2 text-sm font-semibold hover:bg-indigo-500">My Account</a>
            @else
                <a href="{{ route('login') }}" style="background-color: #4f46e5; color: #ffffff;" class="rounded-lg px-5 py-2.5 text-sm font-semibold shadow-sm hover:bg-indigo-500">Log In</a>
            @endauth
        </div>
    </header>

    <main class="content-layer mx-auto flex min-h-[calc(100vh-73px)] max-w-6xl items-center px-6 py-16">
        <div class="grid w-full items-center gap-12 lg:grid-cols-2">
            <div class="readable-panel rounded-2xl p-7 shadow-xl sm:p-10">
                <p class="mb-4 text-sm font-bold uppercase tracking-widest text-indigo-600">Pet Adoption Management</p>
                <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl">Manage pet records with ease.</h1>
                <p class="mt-6 max-w-xl text-lg leading-8 text-slate-600">Securely add and monitor pet records, adoption status, and the latest shelter updates in one place.</p>

                <div class="mt-8 flex flex-wrap gap-4">
                    @auth
                        <a href="{{ auth()->user()->is_admin ? route('dashboard') : route('profile.edit') }}" style="background-color: #4f46e5; color: #ffffff;" class="rounded-lg px-6 py-3 text-base font-semibold shadow-sm hover:bg-indigo-500">Continue</a>
                    @else
                        <a href="{{ route('login') }}" style="background-color: #4f46e5; color: #ffffff;" class="rounded-lg px-6 py-3 text-base font-semibold shadow-sm hover:bg-indigo-500">Log In to Dashboard</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-lg border border-slate-300 bg-white px-6 py-3 text-base font-semibold text-slate-700 hover:bg-slate-50">Create Account</a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="rounded-2xl bg-indigo-700 p-8 text-white shadow-xl sm:p-10">
                <p class="text-sm font-semibold uppercase tracking-wider text-indigo-200">Administrator access</p>
                <h2 class="mt-3 text-2xl font-bold">Pet Records Dashboard</h2>
                <ul class="mt-6 space-y-4 text-indigo-100">
                    <li>• Live totals for registered and adopted pets</li>
                    <li>• Add new pet records directly from the dashboard</li>
                    <li>• Latest pet records and accurate timestamps</li>
                </ul>
            </div>
        </div>
    </main>
</body>
</html>
