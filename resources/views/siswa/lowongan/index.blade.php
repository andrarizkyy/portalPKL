@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', 'Lowongan PKL')
@section('content')
@if($lowongans->isEmpty())
<div class="card p-15 text-center"
    style="background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
    <div class="text-6xl mb-4"><svg style="width:3rem;height:3rem;color:#94a3b8" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg></div>
    <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Lowongan</h3>
    <p class="text-slate-600">Belum ada lowongan PKL yang tersedia saat ini. Cek lagi nanti!</p>
</div>
@else

{{-- Search Bar --}}
@include('components.search-bar', ['target' => 'lowonganCards', 'placeholder' => 'Cari lowongan, perusahaan, atau
 industri...'])

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5" id="lowonganCards">
    @foreach($lowongans as $l)
    <div class="searchable-item group rounded-2xl border border-slate-200 bg-white hover:border-indigo-200 hover:shadow-lg transition-all duration-300 overflow-hidden"
         style="box-shadow: 0 1px 3px rgba(0,0,0,0.04), 0 2px 8px rgba(0,0,0,0.03);">
        <div class="p-5">
            {{-- Company Info --}}
            <div class="flex items-center gap-3 mb-2">
                <div class="w-12 h-12 rounded-lg flex items-center justify-center text-white text-lg font-bold shrink-0"
                     style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                    {{ strtoupper(substr($l->dudiProfile->nama_perusahaan ?? 'D', 0, 2)) }}
                    
                </div>
                <div class="min-w-0">
                    <p class="text-s font-semibold text-slate-800 truncate">{{ $l->dudiProfile->nama_perusahaan ?? '-' }}</p>
                    @if($l->dudiProfile->industry->nama ?? false)
                @if($l->dudiProfile->alamat ?? false)
            <div class="flex items-center mb-1 py-1 gap-1">
                <svg style="width:0.85rem;height:0.85rem;color:#94a3b8;flex-shrink:0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="text-xs text-slate-500 truncate">{{ $l->dudiProfile->alamat }}</span>
            </div>
                @endif
                </div>
            </div>

            {{-- Location --}}
           
             <span class="inline-flex items-center text-xs py-1 rounded-lg font-semibold mt-3"
                      style="color: #6366f1;">
                    {{ $l->dudiProfile->industry->nama }}
                </span>
            @endif
             {{-- Header: Title + Position Count --}}
            <div class="flex items-start justify-between gap-3 mb-3">
                <h3 class="text-xl font-bold text-slate-800 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-snug">
                    {{ $l->judul }}
                </h3>
                <span class="shrink-0 text-xs font-bold px-2.5 py-1 rounded-lg"
                      style="background: rgba(99,102,241,0.08); color: #6366f1;">
                    {{ $l->posisis->count() }} Posisi
                </span>
            </div>

            {{-- Badges Row --}}
            <div class="flex flex-wrap items-center gap-2 mb-3">
                
                @php
                    $now = now();
                    $isNew = $l->created_at && $l->created_at->diffInDays($now) <= 3;
                    $isUrgent = $l->tanggal_selesai && $l->tanggal_selesai->diffInDays($now) <= 7 && $l->tanggal_selesai->isFuture();
                @endphp
                @if($isUrgent)
                <span class="inline-flex items-center text-xs px-2.5 py-1 rounded-lg font-bold"
                      style="background: rgba(239,68,68,0.1); color: #ef4444;">
                    SEGERA
                </span>
                @endif
                @if($isNew)
                <span class="inline-flex items-center text-xs px-2.5 py-1 rounded-lg font-bold"
                      style="background: rgba(16,185,129,0.1); color: #10b981;">
                    <svg style="width:0.6rem;height:0.6rem;margin-right:3px" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                    Baru
                </span>
                @endif
            </div>

            {{-- Position Tags --}}
            <div class="flex flex-wrap gap-1.5 mb-2">
                @foreach($l->posisis->take(3) as $posisi)
                <span class="text-xs px-2 py-0.5 rounded-md font-bold bg-slate-100 text-slate-600">
                    {{ $posisi->nama }}
                </span>
                @endforeach
                @if($l->posisis->count() > 3)
                <span class="text-xs px-2 py-0.5 rounded-md font-bold bg-slate-100 text-slate-500">
                    +{{ $l->posisis->count() - 3 }}
                </span>
                @endif
            </div>
        </div>
           

            

        {{-- Footer --}}
        <div class="px-3 py-3 border-t border-slate-100 flex items-center justify-between"
             style="background: #fafbfc;">
            <div class="flex items-center gap-1.5">
                <svg style="width:0.75rem;height:0.75rem;color:#94a3b8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="text-xs text-slate-500">
                    {{ $l->tanggal_mulai->format('d M') }} — {{ $l->tanggal_selesai->format('d M Y') }}
                </span>
            </div>
            <a href="{{ route('siswa.lowongan.show', $l) }}"
               class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors flex items-center gap-1">
                Lihat Detail
                <svg style="width:0.75rem;height:0.75rem" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
    @endforeach
</div>

{{-- No results message --}}
<div id="noResults_lowonganCards" class="card p-12 text-center"
    style="display: none; background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
    <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
    <p class="text-slate-500 font-medium">Tidak ada lowongan yang cocok dengan pencarian.</p>
</div>
@endif

@endsection

@section('scripts')
<script>
    function searchFilter_lowonganCards(query) {
        const container = document.getElementById('lowonganCards');
        const items = container.querySelectorAll('.searchable-item');
        const noResults = document.getElementById('noResults_lowonganCards');
        const clearBtn = document.getElementById('clearBtn_lowonganCards');
        const countEl = document.getElementById('searchCount_lowonganCards');
        const q = query.toLowerCase().trim();
        let visible = 0;

        clearBtn.style.display = q ? 'block' : 'none';

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            const match = !q || text.includes(q);
            item.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        if (q) {
            countEl.style.display = 'block';
            countEl.textContent = visible + ' dari ' + items.length + ' lowongan ditemukan';
        } else {
            countEl.style.display = 'none';
        }

        noResults.style.display = (q && visible === 0) ? 'block' : 'none';
    }
</script>
@endsection