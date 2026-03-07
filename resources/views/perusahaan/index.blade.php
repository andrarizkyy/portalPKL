@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-2xl font-bold mb-6">Daftar Perusahaan PKL</h1>

    <div class="grid md:grid-cols-3 gap-6">

        @foreach ($dudi as $item)
        <a href="{{ route('perusahaan.show', $item->id) }}"
            class="bg-white rounded-xl shadow p-5 hover:shadow-lg transition">

            <div class="flex items-center gap-3 mb-3">

                {{-- Logo / Huruf --}}
                @if($item->logo)
                <img src="{{ $item->logo }}"
                    class="w-10 h-10 rounded-full object-cover">
                @else
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold"
                    style="background: linear-gradient(135deg,#6366f1,#8b5cf6);">
                    {{ strtoupper(substr($item->nama_perusahaan,0,1)) }}
                </div>
                @endif

                <div>
                    <h2 class="font-semibold">
                        {{ $item->nama_perusahaan }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ $item->bidang_industri }}
                    </p>
                </div>

            </div>

            <p class="text-sm text-gray-600 line-clamp-2">
                {{ $item->deskripsi }}
            </p>

        </a>
        @endforeach

    </div>

</div>
@endsection