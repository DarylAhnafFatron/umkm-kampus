<x-app-layout>
    <x-slot name="header"><h2>Edit UMKM</h2></x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <form method="POST" action="{{ route('umkm.update', $umkm->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Nama UMKM</label>
                <input type="text" name="nama_umkm" value="{{ $umkm->nama_umkm }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Kategori</label>
                <input type="text" name="kategori" value="{{ $umkm->kategori }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="w-full border rounded p-2">{{ $umkm->deskripsi }}</textarea>
            </div>
            <div>
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ $umkm->alamat }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Kontak</label>
                <input type="text" name="kontak" value="{{ $umkm->kontak }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Foto</label>
                @if ($umkm->foto)
                    <img src="{{ asset('storage/' . $umkm->foto) }}" class="h-24 mb-2 rounded">
                @endif
                <input type="file" name="foto" class="border p-2 rounded w-full">
            </div>

            <div class="pt-3">
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                <a href="{{ route('umkm.index') }}" class="ml-2 text-gray-600">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>