<x-app-layout>
    <div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Tambah Produk</h2>

        <form method="POST" action="{{ route('produk.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="block mb-1">Pilih UMKM</label>
        <select name="umkm_id" class="w-full border p-2 rounded" required>
            <option value="">-- Pilih UMKM --</option>
            @foreach ($umkms as $umkm)
                <option value="{{ $umkm->id }}">{{ $umkm->nama_umkm }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="nama_produk" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="harga" class="w-full border p-2 rounded">
    </div>

    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="w-full border p-2 rounded"></textarea>
    </div>

    <div class="mb-3">
        <label>Foto Produk</label>
        <input type="file" name="foto" class="w-full">
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
</form>

    </div>
</x-app-layout>
