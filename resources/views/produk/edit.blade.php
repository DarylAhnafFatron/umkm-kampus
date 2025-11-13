<x-app-layout>
    <div class="max-w-lg mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Edit Produk</h2>

        <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" value="{{ $produk->nama_produk }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" value="{{ $produk->harga }}" class="w-full border p-2 rounded">
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="w-full border p-2 rounded">{{ $produk->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Foto Produk</label><br>
                @if ($produk->foto)
                    <img src="{{ asset('storage/' . $produk->foto) }}" class="w-24 mb-2 rounded">
                @endif
                <input type="file" name="foto" class="w-full">
            </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
        </form>
    </div>
</x-app-layout>
