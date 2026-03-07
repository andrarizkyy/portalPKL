@extends('layouts.app')
@section('sidebar') @include('admin._sidebar') @endsection
@section('page-title', 'Verifikasi DUDI')
@section('page-subtitle', 'Kelola dan verifikasi perusahaan yang mendaftar')

@section('content')
{{-- Filter tabs --}}
<div class="flex gap-2 mb-6 flex-wrap">
    <a href="{{ route('admin.dudi.index') }}"
        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ !request('status') ? 'text-white shadow-md' : 'bg-white text-slate-500 border border-slate-200 hover:bg-slate-50' }}"
        @if(!request('status')) style="background: linear-gradient(135deg, #6366f1, #8b5cf6);" @endif>
        Semua
    </a>
    <a href="{{ route('admin.dudi.index', ['status' => 'pending']) }}"
        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') === 'pending' ? 'text-white shadow-md' : 'bg-white text-slate-500 border border-slate-200 hover:bg-slate-50' }}"
        @if(request('status')==='pending' ) style="background: linear-gradient(135deg, #f59e0b, #f97316);" @endif>
        <svg style="width:0.875rem;height:0.875rem;display:inline;vertical-align:middle;margin-right:2px" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg> Pending
    </a>
    <a href="{{ route('admin.dudi.index', ['status' => 'verified']) }}"
        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') === 'verified' ? 'text-white shadow-md' : 'bg-white text-slate-500 border border-slate-200 hover:bg-slate-50' }}"
        @if(request('status')==='verified' ) style="background: linear-gradient(135deg, #10b981, #0d9488);" @endif>
        <svg style="width:0.875rem;height:0.875rem;display:inline;vertical-align:middle;margin-right:2px" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg> Terverifikasi
    </a>
    <a href="{{ route('admin.dudi.index', ['status' => 'rejected']) }}"
        class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') === 'rejected' ? 'text-white shadow-md' : 'bg-white text-slate-500 border border-slate-200 hover:bg-slate-50' }}"
        @if(request('status')==='rejected' ) style="background: linear-gradient(135deg, #ef4444, #ec4899);" @endif>
        <svg style="width:0.875rem;height:0.875rem;display:inline;vertical-align:middle;margin-right:2px" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg> Ditolak
    </a>
</div>

{{-- Search Bar --}}
@include('components.search-bar', ['target' => 'dudiTable', 'placeholder' => 'Cari perusahaan, pemilik akun, atau
industri...'])

<div class="card overflow-hidden"
    style="background: linear-gradient(135deg, #faf5ff 0%, #f8fafc 100%); border-color: #e9d5ff;">
    @if($dudis->isEmpty())
    <div class="p-16 text-center">
        <div class="text-6xl mb-4"><svg style="width:3rem;height:3rem;color:#94a3b8" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg></div>
        <h3 class="text-xl font-bold text-slate-700 mb-2">Belum Ada Data DUDI</h3>
        <p class="text-slate-600">Tidak ada perusahaan yang sesuai dengan filter saat ini.</p>
    </div>
    @else
    <table class="w-full">
        <thead class="table-header">
            <tr>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Perusahaan
                </th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Pemilik Akun
                </th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Industri</th>
                <th class="text-left px-6 py-4 text-xs font-bold text-slate-600 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4"></th>
            </tr>
        </thead>
        <tbody id="dudiTable">
            @foreach($dudis as $d)
            <tr class="table-row searchable-item">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-white shrink-0 text-sm"
                            style="background: linear-gradient(135deg, #6366f1, #8b5cf6);">
                            {{ strtoupper(substr($d->nama_perusahaan, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">{{ $d->nama_perusahaan }}</p>
                            <p class="text-xs text-slate-600">{{ $d->telepon }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <p class="text-sm font-medium text-slate-700">{{ $d->user->name }}</p>
                    <p class="text-xs text-slate-600">{{ $d->user->email }}</p>
                </td>
                <td class="px-6 py-4">
                    <span class="text-xs px-2.5 py-1 rounded-lg font-medium"
                        style="background: rgba(99,102,241,0.08); color: #6366f1;">
                        {{ $d->industry->nama ?? '-' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    @if($d->status === 'verified')
                    <span class="badge badge-approved"><svg
                            style="width:0.75rem;height:0.75rem;display:inline;vertical-align:middle;margin-right:2px"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg> Verified</span>
                    @elseif($d->status === 'rejected')
                    <span class="badge badge-rejected"><svg
                            style="width:0.75rem;height:0.75rem;display:inline;vertical-align:middle;margin-right:2px"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg> Ditolak</span>
                    @else
                    <span class="badge badge-pending"><svg
                            style="width:0.75rem;height:0.75rem;display:inline;vertical-align:middle;margin-right:2px"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg> Pending</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    <a href="{{ route('admin.dudi.show', $d) }}" class="btn-outline btn-sm">Detail →</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- No results --}}
    <div id="noResults_dudiTable" class="p-12 text-center" style="display: none;">
        <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <p class="text-slate-500 font-medium">Tidak ada DUDI yang cocok.</p>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    function searchFilter_dudiTable(query) {
        const container = document.getElementById('dudiTable');
        if (!container) return;
        const items = container.querySelectorAll('.searchable-item');
        const noResults = document.getElementById('noResults_dudiTable');
        const clearBtn = document.getElementById('clearBtn_dudiTable');
        const countEl = document.getElementById('searchCount_dudiTable');
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
            countEl.textContent = visible + ' dari ' + items.length + ' DUDI ditemukan';
        } else {
            countEl.style.display = 'none';
        }

        noResults.style.display = (q && visible === 0) ? 'block' : 'none';
    }
</script>
@endsection