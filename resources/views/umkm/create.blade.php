<x-app-layout>
    <x-slot name="header"><h2>Tambah UMKM</h2></x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <form method="POST" action="{{ route('umkm.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label>Nama UMKM</label>
                <input type="text" name="nama_umkm" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Kategori</label>
                <input type="text" name="kategori" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="w-full border rounded p-2"></textarea>
            </div>
            <div>
                <label>Alamat</label>
                <input type="text" name="alamat" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Kontak</label>
                <input type="text" name="kontak" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Foto (opsional)</label>
                <input type="file" name="foto" class="border p-2 rounded w-full">
            </div>

            <div class="pt-3">
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                <a href="{{ route('umkm.index') }}" class="ml-2 text-gray-600">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>