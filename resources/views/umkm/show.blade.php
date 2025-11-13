<x-app-layout>
    <x-slot name="header"><h2>Detail UMKM</h2></x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white shadow rounded p-6 space-y-3">
            @if ($umkm->foto)
                <img src="{{ asset('storage/' . $umkm->foto) }}" class="w-32 rounded mb-3">
            @endif
            <h3 class="text-xl font-semibold">{{ $umkm->nama_umkm }}</h3>
            <p><strong>Kategori:</strong> {{ $umkm->kategori }}</p>
            <p><strong>Alamat:</strong> {{ $umkm->alamat }}</p>
            <p><strong>Kontak:</strong> {{ $umkm->kontak }}</p>
            <p><strong>Deskripsi:</strong> {{ $umkm->deskripsi }}</p>

            <a href="{{ route('umkm.index') }}" class="text-blue-600">← Kembali</a>
        </div>
    </div>
</x-app-layout>