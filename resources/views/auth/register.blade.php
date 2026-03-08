<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Portal PKL</title>
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

        .gradient-text {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl sm:rounded-xl overflow-hidden shadow-lg
                    bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">

                    <img src="/coba4.png"
                    alt="logo"
                    class="w-full h-full object-cover group-hover:scale-110 transition duration-300">

                    </div>
                <span class="text-2xl font-bold text-white">Portal <span class="gradient-text">PKL</span></span>
            </a>
            <p class="text-slate-300 mt-2 text-sm">Buat akun baru Anda</p>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            @if(session('error'))
            <div class="mb-5 px-4 py-3 rounded-2xl text-sm text-amber-700 bg-amber-50 border border-amber-100">
                <p>{{ session('error') }}</p>
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 px-4 py-3 rounded-2xl text-sm text-red-700 bg-red-50 border border-red-100">
                @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-slate-800">Daftar Sekarang</h2>
                <p class="text-slate-500 text-sm mt-1">Pilih jenis akun yang ingin Anda buat</p>
            </div>

            {{-- Google Register Buttons --}}
            <div class="space-y-4">
                <a href="{{ route('google.redirect', 'siswa') }}"
                    class="w-full flex items-center justify-center gap-3 py-4 rounded-xl border-2 border-slate-100 font-semibold text-slate-600 text-sm hover:bg-slate-50 hover:border-slate-200 transition-all">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Daftar Sebagai Siswa
                </a>

                <a href="{{ route('google.redirect', 'dudi') }}"
                    class="w-full flex items-center justify-center gap-3 py-4 rounded-xl border-2 border-slate-100 font-semibold text-slate-600 text-sm hover:bg-slate-50 hover:border-slate-200 transition-all">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4"
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 01-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" />
                        <path fill="#34A853"
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path fill="#FBBC05"
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path fill="#EA4335"
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Daftar Sebagai DUDI
                </a>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-500">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-700">Masuk</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>