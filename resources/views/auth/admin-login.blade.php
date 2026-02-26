<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Portal PKL</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: linear-gradient(140deg, #0a0628 0%, #130d3d 40%, #1e0a4a 75%, #0f0a25 100%);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center font-black text-white text-lg shadow-lg"
                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">P</div>
                <span class="text-2xl font-bold text-white">Portal PKL</span>
            </a>
            <p class="text-slate-300 mt-2 text-sm">Login Administrator</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            @if($errors->any())
            <div class="mb-5 px-4 py-3 rounded-2xl text-sm text-red-700 bg-red-50 border border-red-100">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all placeholder:text-slate-400"
                        placeholder="admin@portal.com" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all placeholder:text-slate-400"
                        placeholder="••••••••" required>
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-xl font-bold text-white text-sm transition-all hover:opacity-90 hover:-translate-y-0.5 shadow-md"
                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                    Masuk sebagai Admin
                </button>
            </form>
        </div>

        <p class="text-center mt-5">
            <a href="{{ route('login') }}" class="text-xs text-slate-400 hover:text-slate-500">← Kembali ke Login
                Utama</a>
        </p>
    </div>
</body>

</html>