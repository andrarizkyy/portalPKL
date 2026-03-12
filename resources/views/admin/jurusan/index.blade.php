@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Data Jurusan')
@section('header-actions')
<a href="{{ route('admin.jurusan.create') }}" class="btn-primary">Tambah Jurusan</a>
@endsection
@section('content')
@if($sekolahs->isEmpty())
<div class="card p-12 text-center"
    style="background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
    <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
    </svg>
    <p class="text-slate-600 font-medium">Belum ada sekolah terdaftar.</p>
    <p class="text-slate-500 text-sm mt-1">Tambahkan sekolah terlebih dahulu sebelum menambah jurusan.</p>
</div>
@else

{{-- Search Bar --}}
@include('components.search-bar', ['target' => 'jurusanList', 'placeholder' => 'Cari sekolah atau jurusan...'])

<div class="space-y-4" id="jurusanList">
    @foreach($sekolahs as $sekolah)
    @php $jurusanList = $jurusans->where('sekolah_id', $sekolah->id); @endphp
    <div class="card overflow-hidden searchable-item"
        style="background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
        {{-- School header - clickable accordion --}}
        <button onclick="toggleAccordion('school-{{ $sekolah->id }}')"
            class="w-full flex items-center justify-between px-5 py-4 hover:bg-blue-50/50 transition-colors">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                    style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="text-left">
                    <p class="font-bold text-slate-800">{{ $sekolah->nama }}</p>
                    <p class="text-xs text-slate-500">{{ $jurusanList->count() }} jurusan</p>
                </div>
            </div>
            <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 accordion-arrow"
                id="arrow-school-{{ $sekolah->id }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        {{-- Jurusan list --}}
        <div id="school-{{ $sekolah->id }}" class="accordion-content border-t border-slate-100" style="display: none;">
            <div class="px-5 py-4">
                @if($jurusanList->isEmpty())
                <p class="text-sm text-slate-500 italic">Belum ada jurusan untuk sekolah ini.</p>
                @else
                <div class="flex flex-wrap gap-2">
                    @foreach($jurusanList as $j)
                    <div
                        class="group inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-white border border-slate-200 shadow-sm hover:shadow transition-all">
                        <span class="text-sm font-medium text-slate-700">{{ $j->nama }}</span>
                        <div class="flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.jurusan.edit', $j) }}"
                                class="text-indigo-500 hover:text-indigo-700" title="Edit">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form method="POST" action="{{ route('admin.jurusan.destroy', $j) }}" class="inline"
                                onsubmit="return confirm('Hapus jurusan {{ $j->nama }}?')">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:text-red-600">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- No results --}}
<div id="noResults_jurusanList" class="card p-12 text-center"
    style="display: none; background: linear-gradient(135deg, #eff6ff 0%, #f8fafc 100%); border-color: #bfdbfe;">
    <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
    </svg>
    <p class="text-slate-500 font-medium">Tidak ada jurusan yang cocok.</p>
</div>
@endif
@endsection

@section('scripts')
<script>
    function toggleAccordion(id) {
        const content = document.getElementById(id);
        const arrow = document.getElementById('arrow-' + id);
        if (content.style.display === 'none') {
            content.style.display = 'block';
            arrow.style.transform = 'rotate(180deg)';
        } else {
            content.style.display = 'none';
            arrow.style.transform = 'rotate(0deg)';
        }
    }
    // Open all accordions that have jurusan by default
    document.addEventListener('DOMContentLoaded', function () {
        @foreach($sekolahs as $sekolah)
        @if ($jurusans -> where('sekolah_id', $sekolah -> id) -> count() > 0)
            toggleAccordion('school-{{ $sekolah->id }}');
        @endif
        @endforeach
    });

    function searchFilter_jurusanList(query) {
        const container = document.getElementById('jurusanList');
        const items = container.querySelectorAll('.searchable-item');
        const noResults = document.getElementById('noResults_jurusanList');
        const clearBtn = document.getElementById('clearBtn_jurusanList');
        const countEl = document.getElementById('searchCount_jurusanList');
        const q = query.toLowerCase().trim();
        let visible = 0;

        clearBtn.style.display = q ? 'block' : 'none';

        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            const match = !q || text.includes(q);
            item.style.display = match ? '' : 'none';
            if (match) {
                visible++;
                // Auto-open accordion when searching
                const accordion = item.querySelector('.accordion-content');
                if (q && accordion) accordion.style.display = 'block';
            }
        });

        if (q) {
            countEl.style.display = 'block';
            countEl.textContent = visible + ' dari ' + items.length + ' sekolah ditemukan';
        } else {
            countEl.style.display = 'none';
        }

        noResults.style.display = (q && visible === 0) ? 'block' : 'none';
    }
</script>
@endsection