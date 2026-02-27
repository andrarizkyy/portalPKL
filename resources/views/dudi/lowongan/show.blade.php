@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', $lowongan->judul)

@section('content')
<div class="max-w-4xl">
    <div class="card p-6 mb-6"
        style="background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 100%); border-color: #c7d2fe;">
        @if($lowongan->gambar)
        <img src="{{ asset('storage/' . $lowongan->gambar) }}" class="w-full h-56 object-cover rounded-xl mb-6" alt="">
        @endif

        <div class="flex items-center gap-2 mb-4">
            @if($lowongan->is_published)
            <span class="badge badge-verified">Dipublikasikan</span>
            @else
            <span class="badge bg-slate-200 text-slate-600">Draft</span>
            @endif
            <span class="badge bg-slate-100 text-slate-600">{{ $lowongan->tanggal_mulai->format('d M Y') }} - {{
                $lowongan->tanggal_selesai->format('d M Y') }}</span>
        </div>

        <div class="prose prose-sm max-w-none text-slate-600 mb-6">
            {!! nl2br(e($lowongan->deskripsi)) !!}
        </div>

        <h3 class="text-lg font-bold text-slate-800 mb-4">Posisi & Pelamar</h3>
        <div class="space-y-3">
            @foreach($lowongan->posisis as $posisi)
            <div class="p-4 bg-slate-50 rounded-xl border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-slate-800">{{ $posisi->nama }}</p>
                        <p class="text-sm text-slate-500">Kuota: {{ $posisi->kuota }} | Pelamar: {{
                            $posisi->pendaftaranPkls->count() }} | Diterima: {{
                            $posisi->pendaftaranPkls->where('status', 'approved')->count() }}</p>
                    </div>
                    <span class="badge {{ $posisi->sisaTempat() > 0 ? 'badge-verified' : 'badge-rejected' }}">
                        Sisa: {{ $posisi->sisaTempat() }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('dudi.lowongan.edit', $lowongan) }}" class="btn-primary">Edit</a>
        <a href="{{ route('dudi.lowongan.index') }}" class="btn-outline">← Kembali</a>
    </div>
</div>
@endsection