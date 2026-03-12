@extends('layouts.app')
@section('sidebar') @include('dudi._sidebar') @endsection
@section('page-title', 'Buat Lowongan Baru')

@section('content')
<div class="card max-w-3xl"
    style="background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 100%); border-color: #c7d2fe;">
    <form method="POST" action="{{ route('dudi.lowongan.store') }}" enctype="multipart/form-data" class="p-6 space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Judul Lowongan *</label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="input-field" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Gambar Cover</label>
            <input type="file" name="gambar" class="input-field" accept="image/*">
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1.5">Deskripsi *</label>
            <textarea name="deskripsi" rows="5" class="input-field" required>{{ old('deskripsi') }}</textarea>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Mulai *</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" class="input-field" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Tanggal Selesai *</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" class="input-field"
                    required>
            </div>
        </div>

        {{-- Dynamic Positions --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-3">Posisi *</label>
            <div id="posisi-container" class="space-y-4">
                <div class="posisi-row border border-slate-200 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-xs font-semibold text-slate-500 uppercase tracking-wide">Posisi 1</label>
                        <button type="button" onclick="this.closest('.posisi-row').remove()"
                            class="text-red-400 hover:text-red-600 text-sm font-medium">Hapus</button>
                    </div>
                    <div class="mb-3">
                        <label class="block text-xs font-medium text-slate-500 mb-1">Nama Posisi / Jabatan</label>
                        <input type="text" name="posisis[0][nama]" placeholder="Contoh: Web Developer"
                            class="input-field" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-slate-500 mb-1">Kuota</label>
                        <input type="number" name="posisis[0][kuota]" placeholder="Kuota" class="input-field"
                            style="width: 8rem;" min="1" value="1" required>
                    </div>
                </div>
            </div>
            <button type="button" onclick="addPosisi()"
                class="mt-3 text-sm text-indigo-600 font-semibold hover:text-indigo-800">Tambah Posisi</button>
        </div>

        <div class="flex items-center gap-3">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_published" value="1"
                    class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                <span class="text-sm font-medium text-slate-700">Publikasikan langsung</span>
            </label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">Simpan Lowongan</button>
            <a href="{{ route('dudi.lowongan.index') }}" class="btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let posisiIndex = 1;
    function addPosisi() {
        posisiIndex++;
        const container = document.getElementById('posisi-container');
        const html = `<div class="posisi-row border border-slate-200 rounded-xl p-4">
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
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
    }
</script>
@endsection