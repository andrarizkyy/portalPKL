<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Role — Portal PKL</title>
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
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-3">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center font-black text-white text-lg shadow-lg"
                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">P</div>
                <span class="text-2xl font-bold text-white">Portal PKL</span>
            </a>
            <p class="text-slate-300 mt-2 text-sm">Pilih peran Anda untuk melanjutkan</p>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
            <form method="POST" action="{{ route('select.role') }}" class="space-y-4">
                @csrf
                <button type="submit" name="role" value="siswa"
                    class="w-full flex items-center gap-4 py-4 px-5 rounded-2xl border-2 border-slate-100 hover:border-blue-300 hover:bg-blue-50/50 transition-all text-left">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-xl"><svg style="width:1.25rem;height:1.25rem;color:white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg></span>
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 text-base">Siswa</p>
                        <p class="text-xs text-slate-400">Cari & lamar posisi PKL</p>
                    </div>
                </button>

                <button type="submit" name="role" value="dudi"
                    class="w-full flex items-center gap-4 py-4 px-5 rounded-2xl border-2 border-slate-100 hover:border-purple-300 hover:bg-purple-50/50 transition-all text-left">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-xl"><svg style="width:1.25rem;height:1.25rem;color:white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg></span>
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 text-base">DUDI</p>
                        <p class="text-xs text-slate-400">Buka lowongan PKL untuk siswa</p>
                    </div>
                </button>
            </form>
        </div>
    </div>
</body>

</html>