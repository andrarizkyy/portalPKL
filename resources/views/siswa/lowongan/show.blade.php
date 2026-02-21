@extends('layouts.app')
@section('sidebar') @include('siswa._sidebar') @endsection
@section('page-title', $lowongan->title)
@section('page-subtitle', $lowongan->dudiProfile->company_name)

@section('content')
<div class="max-w-4xl">
    <div class="card p-6 mb-6">
        @if($lowongan->image)
        <img src="{{ asset('storage/' . $lowongan->image) }}" class="w-full h-64 object-cover rounded-xl mb-6" alt="">
        @endif

        <div class="flex flex-wrap gap-2 mb-4">
            <span class="badge bg-indigo-100 text-indigo-800">{{ $lowongan->dudiProfile->industry->name ?? '' }}</span>
            <span class="badge bg-slate-100 text-slate-600">{{ $lowongan->start_date->format('d M Y') }} - {{
                $lowongan->end_date->format('d M Y') }}</span>
        </div>

        <div class="prose prose-sm max-w-none text-slate-600 mb-6">
            {!! nl2br(e($lowongan->description)) !!}
        </div>

        <div class="border-t border-slate-100 pt-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Posisi yang Tersedia</h3>
            <div class="space-y-3">
                @foreach($lowongan->posisis as $posisi)
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl border border-slate-100">
                    <div>
                        <p class="font-semibold text-slate-800">{{ $posisi->position_name }}</p>
                        <p class="text-sm text-slate-500">Kuota: {{ $posisi->sisaTempat() }}/{{ $posisi->kuota }}
                            tersisa</p>
                    </div>
                    @if(in_array($posisi->id, $appliedPosisiIds))
                    <span class="badge badge-pending">Sudah Dilamar</span>
                    @elseif($posisi->sisaTempat() > 0)
                    <a href="{{ route('siswa.lamar', [$lowongan, $posisi]) }}" class="btn-primary text-sm">Lamar
                        Posisi</a>
                    @else
                    <span class="badge bg-slate-200 text-slate-500">Kuota Penuh</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <a href="{{ route('siswa.lowongan.index') }}" class="btn-outline">← Kembali</a>
</div>
@endsection