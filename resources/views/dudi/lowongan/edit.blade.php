@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Edit Lowongan')

@section('content')
<div class="card max-w-3xl">
    <form method="POST" action="{{ route('dudi.lowongan.update', $lowongan) }}" enctype="multipart/form-data"
        class="p-6 space-y-5">
        @csrf @method('PUT')
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Lowongan *</label>
            <input type="text" name="judul" value="{{ old('judul', $lowongan->judul) }}" class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Gambar Cover</label>
            @if($lowongan->gambar)
            <img src="{{ asset('storage/' . $lowongan->gambar) }}" class="w-48 h-32 object-cover rounded-lg mb-2">
            @endif
            <input type="file" name="image" class="input-field" accept="image/*">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi *</label>
            <textarea name="deskripsi" rows="5" class="input-field"
                required>{{ old('deskripsi', $lowongan->deskripsi) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Mulai *</label>
                <input type="date" name="tanggal_mulai"
                    value="{{ old('tanggal_mulai', $lowongan->tanggal_mulai->format('Y-m-d')) }}" class="input-field"
                    required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Selesai *</label>
                <input type="date" name="tanggal_selesai"
                    value="{{ old('tanggal_selesai', $lowongan->tanggal_selesai->format('Y-m-d')) }}"
                    class="input-field" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-3">Posisi *</label>
            <div id="posisi-container" class="space-y-4">
                @foreach($lowongan->posisis as $i => $p)
                <div class="posisi-row border border-slate-200 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Posisi {{ $i + 1
                            }}</label>
                        <button type="button" onclick="this.closest('.posisi-row').remove()"
                            class="text-red-400 hover:text-red-600 text-sm font-medium">Hapus</button>
                    </div>
                    <div class="mb-3">
                        <label class="block text-xs font-medium text-slate-500 mb-1">Nama Posisi / Jabatan</label>
                        <input type="text" name="posisis[{{ $i }}][nama]" value="{{ $p->nama }}" class="input-field"
                            required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Kuota</label>
                        <input type="number" name="posisis[{{ $i }}][kuota]" value="{{ $p->kuota }}" class="input-field"
                            style="width: 8rem;" min="1" required>
                    </div>
                </div>
                @endforeach
            </div>
            <button type="button" onclick="addPosisi()"
                class="mt-3 text-sm text-indigo-600 font-semibold hover:text-indigo-800">+ Tambah Posisi</button>
        </div>

        <div class="flex items-center gap-3">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ $lowongan->is_published ? 'checked' : '' }}
                class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <span class="text-sm font-medium text-slate-700">Publikasikan</span>
            </label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Update Lowongan</button>
            <a href="{{ route('dudi.lowongan.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let posisiIndex = {{ count($lowongan -> posisis) }};
    function addPosisi() {
        posisiIndex++;
        const container = document.getElementById('posisi-container');
        container.insertAdjacentHTML('beforeend', `<div class="posisi-row border border-slate-200 rounded-xl p-4">
            <div class="flex items-center justify-between mb-3">
                <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Posisi ${posisiIndex}</label>
                <button type="button" onclick="this.closest('.posisi-row').remove()" class="text-red-400 hover:text-red-600 text-sm font-medium">Hapus</button>
            </div>
            <div class="mb-3">
                <label class="block text-xs font-medium text-slate-500 mb-1">Nama Posisi / Jabatan</label>
                <input type="text" name="posisis[${posisiIndex - 1}][nama]" placeholder="Contoh: Web Developer" class="input-field" required>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-500 mb-1">Kuota</label>
                <input type="number" name="posisis[${posisiIndex - 1}][kuota]" placeholder="Kuota" class="input-field" style="width: 8rem;" min="1" value="1" required>
            </div>
        </div>`);
    }
</script>
@endsection