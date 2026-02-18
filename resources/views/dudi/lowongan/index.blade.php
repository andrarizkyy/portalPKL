@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Lowongan Saya')
@section('header-actions')
@if($profile && $profile->status === 'verified')
<a href="{{ route('dudi.lowongan.create') }}" class="btn-primary">+ Buat Lowongan</a>
@endif
@endsection

@section('content')
@if(!$profile || $profile->status !== 'verified')
<div class="bg-amber-50 border border-amber-200 rounded-2xl p-6">
    <p class="text-amber-800 font-medium">Perusahaan Anda harus terverifikasi sebelum bisa membuat lowongan.</p>
</div>
@else
<div class="space-y-4">
    @forelse($lowongans as $l)
    <div class="card p-6 hover:shadow-md transition-shadow">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <h3 class="text-lg font-bold text-slate-800">{{ $l->judul }}</h3>
                    @if($l->is_published)
                    <span class="badge badge-verified">Dipublikasikan</span>
                    @else
                    <span class="badge bg-slate-200 text-slate-600">Draft</span>
                    @endif
                </div>
                <p class="text-sm text-slate-500 mb-2">{{ $l->tanggal_mulai->format('d M Y') }} — {{
                    $l->tanggal_selesai->format('d M Y') }}</p>
                <div class="flex gap-2">
                    @foreach($l->posisis as $p)
                    <span class="text-xs bg-indigo-50 text-indigo-700 px-2 py-1 rounded-lg">{{ $p->nama }} ({{ $p->kuota
                        }})</span>
                    @endforeach
                </div>
            </div>
            <div class="flex gap-2 ml-4">
                <a href="{{ route('dudi.lowongan.show', $l) }}"
                    class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Detail</a>
                <a href="{{ route('dudi.lowongan.edit', $l) }}"
                    class="text-slate-600 hover:text-slate-800 text-sm font-medium">Edit</a>
                <form method="POST" action="{{ route('dudi.lowongan.destroy', $l) }}" class="inline"
                    onsubmit="return confirm('Hapus?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-16">
        <p class="text-slate-400 text-lg mb-4">Belum ada lowongan.</p>
        <a href="{{ route('dudi.lowongan.create') }}" class="btn-primary">+ Buat Lowongan Pertama</a>
    </div>
    @endforelse
</div>
@endif
@endsection