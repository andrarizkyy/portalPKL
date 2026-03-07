@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">

    <div class="bg-white shadow rounded-xl p-6">

        <div class="flex items-center gap-4 mb-6">

            {{-- Logo --}}
            @if($dudi->logo)
            <img src="{{ $dudi->logo }}"
                class="w-16 h-16 rounded-full object-cover">
            @else
            <div class="w-16 h-16 rounded-full flex items-center justify-center text-white text-xl font-bold"
                style="background: linear-gradient(135deg,#6366f1,#8b5cf6);">
                {{ strtoupper(substr($dudi->nama_perusahaan,0,1)) }}
            </div>
            @endif

            <div>
                <h1 class="text-2xl font-bold">
                    {{ $dudi->nama_perusahaan }}
                </h1>

                <p class="text-gray-500">
                    {{ $dudi->bidang_industri }}
                </p>
            </div>

        </div>

        <div class="mb-4">
            <h2 class="font-semibold mb-1">Alamat</h2>
            <p class="text-gray-600">
                {{ $dudi->alamat }}
            </p>
        </div>

        <div>
            <h2 class="font-semibold mb-1">Deskripsi</h2>
            <p class="text-gray-600">
                {{ $dudi->deskripsi }}
            </p>
        </div>

    </div>

</div>
@endsection