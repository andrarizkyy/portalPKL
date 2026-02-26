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
                        <span class="text-xl">📚</span>
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
                        <span class="text-xl">🏢</span>
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