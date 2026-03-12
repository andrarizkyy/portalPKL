@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lamaran Saya')

@section('content')

<div class="card overflow-hidden"
    style="background: linear-gradient(135deg, #faf5ff 0%, #f8fafc 100%); border-color: #e9d5ff;">
    @if($lamarans->isEmpty())
    <div class="p-16 text-center">
        <div class="text-6xl mb-4"><svg style="width:3rem;height:3rem;color:#94a3b8" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg></div>
        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lamaran</h3>
        <p class="text-slate-600 mb-6">Anda belum melamar ke lowongan manapun. Yuk, temukan lowongan yang cocok!</p>
        <a href="{{ route('siswa.lowongan.index') }}" class="btn-primary">Cari Lowongan →</a>
    </div>
    @else
    <div class="px-8 pt-4 pb-2">
        @include('components.search-bar', ['target' => 'lamaranGrid', 'placeholder' => 'Cari lamaran, perusahaan, atau status...'])
    </div>
<div class="px-8 pt-2 pb-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="lamaranGrid">
        @foreach($lamarans as $l)
        @php
            $statusMap = [
                'pending'   => ['bg-yellow-50 text-yellow-700 border-yellow-200', 'Pending'],
                'approved'  => ['bg-green-50 text-green-700 border-green-200', 'Diterima'],
                'rejected'  => ['bg-red-50 text-red-700 border-red-200', 'Ditolak'],
                'cancelled' => ['bg-gray-50 text-gray-600 border-gray-200', 'Dibatalkan'],
            ];
            $s = $statusMap[$l->status] ?? ['bg-gray-50 text-gray-600 border-gray-200', ucfirst($l->status)];
        @endphp

        <div class="searchable-item bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col overflow-hidden group">
            
            <div class="p-5 flex-grow">
                <div class="mb-4">
                    <span class="inline-block px-3 py-1 text-[10px] font-bold uppercase tracking-wider rounded-full border {{ $s[0] }}">
                        {{ $s[1] }}
                    </span>
                </div>

                <h4 class="font-bold text-slate-800 text-lg group-hover:text-indigo-600 transition-colors line-clamp-1">
                    {{ $l->posisi->lowongan->judul ?? '-' }}
                </h4>
                <p class="text-sm font-medium text-slate-500 mb-4">
                    {{ $l->posisi->nama ?? '-' }}
                </p>

                <div class="space-y-3 pt-4 border-t border-slate-50">
                    {{-- Perusahaan --}}
                    <div class="flex items-center text-slate-600">
                        <div class="p-2 bg-slate-100 rounded-lg mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-10V4m0 10V4m-4 11h.01" /></svg>
                        </div>
                        <span class="text-sm font-semibold truncate">{{ $l->posisi->lowongan->dudiProfile->nama_perusahaan ?? '-' }}</span>
                    </div>

                    {{-- Tanggal --}}
                    <div class="flex items-center text-slate-500">
                        <div class="p-2 bg-slate-100 rounded-lg mr-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <span class="text-xs">Melamar: {{ $l->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


    {{-- No results --}}
    <div id="noResults_lamaranTable" class="p-12 text-center" style="display: none;">
        <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <p class="text-slate-500 font-medium">Tidak ada lamaran yang cocok.</p>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function searchFilter_lamaranGrid(query) {

    const container = document.getElementById('lamaranGrid');
    if (!container) return;

    const items = container.querySelectorAll('.searchable-item');
    const noResults = document.getElementById('noResults_lamaranTable');
    const clearBtn = document.getElementById('clearBtn_lamaranGrid');
    const countEl = document.getElementById('searchCount_lamaranGrid');

    const q = query.toLowerCase().trim();
    let visible = 0;

    if (clearBtn) clearBtn.style.display = q ? 'block' : 'none';

    items.forEach(item => {

        const text = item.textContent
            .toLowerCase()
            .replace(/\s+/g,' ');

        const match = !q || text.includes(q);

        item.style.display = match ? '' : 'none';

        if (match) visible++;

    });

    if (countEl) {
        if (q) {
            countEl.style.display = 'block';
            countEl.textContent = visible + ' dari ' + items.length + ' lamaran ditemukan';
        } else {
            countEl.style.display = 'none';
        }
    }

    if (noResults) {
        noResults.style.display = (q && visible === 0) ? 'block' : 'none';
    }

}
</script>
@endsection