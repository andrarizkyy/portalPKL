@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Data Industry')
@section('header-actions')
<a href="{{ route('admin.industry.create') }}" class="btn-primary">Tambah Industri</a>
@endsection
@section('content')

{{-- Search Bar --}}
@include('components.search-bar', ['target' => 'industryTable', 'placeholder' => 'Cari nama industri...'])

<div class="card" style="background: linear-gradient(135deg, #faf5ff 0%, #f8fafc 100%); border-color: #e9d5ff;">
    <table class="w-full">
        <thead>
            <tr class="border-b border-slate-100">
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                <th class="text-left px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama
                    Industry</th>
                <th class="text-right px-6 py-4 text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody id="industryTable">
            @forelse($industries as $i => $ind)
            <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors searchable-item">
                <td class="px-6 py-4 text-sm text-slate-500">{{ $i + 1 }}</td>
                <td class="px-6 py-4 text-sm font-semibold text-slate-800">{{ $ind->nama }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('admin.industry.edit', $ind) }}"
                        class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                    <form method="POST" action="{{ route('admin.industry.destroy', $ind) }}" class="inline"
                        onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="px-6 py-12 text-center text-slate-600">Belum ada data industry.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- No results --}}
    <div id="noResults_industryTable" class="p-12 text-center" style="display: none;">
        <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <p class="text-slate-500 font-medium">Tidak ada industri yang cocok.</p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function searchFilter_industryTable(query) {
        const container = document.getElementById('industryTable');
        const items = container.querySelectorAll('.searchable-item');
        const noResults = document.getElementById('noResults_industryTable');
        const clearBtn = document.getElementById('clearBtn_industryTable');
        const countEl = document.getElementById('searchCount_industryTable');
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
            countEl.textContent = visible + ' dari ' + items.length + ' industri ditemukan';
        } else {
            countEl.style.display = 'none';
        }

        noResults.style.display = (q && visible === 0) ? 'block' : 'none';
    }
</script>
@endsection