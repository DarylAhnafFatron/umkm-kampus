<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
            <h2 class="text-2xl font-semibold text-gray-800">📦 Daftar Produk</h2>

            @if(Auth::user()->role === 'user')
                <a href="{{ route('produk.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition duration-200">
                    + Tambah Produk
                </a>
            @endif
        </div>

        {{-- 🔍 Search & Filter --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            @if(Auth::user()->role === 'admin')
                <form method="GET" action="{{ route('produk.index') }}" class="flex gap-2 w-full sm:w-1/2">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari produk..."
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Cari
                    </button>
                </form>
            @endif

            @if(Auth::user()->role === 'user')
                <form method="GET" action="{{ route('produk.index') }}" class="flex gap-2 w-full sm:w-1/2">
                    <select name="umkm_id" class="border border-gray-300 rounded-lg px-3 py-2 w-full"
                            onchange="this.form.submit()">
                        <option value="">Semua UMKM</option>
                        @foreach (\App\Models\Umkm::where('user_id', Auth::id())->get() as $umkm)
                            <option value="{{ $umkm->id }}" {{ request('umkm_id') == $umkm->id ? 'selected' : '' }}>
                                {{ $umkm->nama_umkm }}
                            </option>
                        @endforeach
                    </select>
                </form>
            @endif
        </div>

        {{-- ✅ Tabel Produk --}}
        <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
            <table class="w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-center text-gray-800 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-4 py-3">Nama Produk</th>
                        <th class="px-4 py-3">UMKM</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Foto</th>
                        <th class="px-4 py-3">Pemilik</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $produk)
                        <tr class="border-t hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center">{{ $produk->nama_produk }}</td>
                            <td class="px-4 py-3 text-center">{{ $produk->umkm->nama_umkm }}</td>
                            <td class="px-4 py-3 text-center">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($produk->foto)
                                    <img src="{{ asset('storage/' . $produk->foto) }}"
                                         class="w-16 h-16 object-cover rounded mx-auto shadow-sm">
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">{{ $produk->umkm->user->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('produk.edit', $produk->id) }}"
                                       class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">Belum ada produk tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
