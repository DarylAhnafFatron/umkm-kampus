<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Daftar UMKM') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

@if(Auth::user()->role === 'user')
    <div class="mb-4">
        <a href="{{ route('umkm.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Tambah UMKM
        </a>
    </div>
@endif


        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-4">
            <table class="min-w-full text-sm border-collapse">
                <thead class="border-b bg-gray-100">
                    <tr>
                        <th class="text-center px-4 py-2">Nama UMKM</th>
                        <th class="text-center px-4 py-2">Kategori</th>
                        <th class="text-center px-4 py-2">Pemilik</th>
                        <th class="text-center px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($umkms as $u)
                        <tr class="border-b hover:bg-gray-50 text-center">
                            <td class="px-4 py-2 align-middle">{{ $u->nama_umkm }}</td>
                            <td class="px-4 py-2 align-middle">{{ $u->kategori }}</td>
                            <td class="px-4 py-2 align-middle">{{ $u->user->name ?? '-' }}</td>
                            <td class="px-4 py-2 flex justify-center gap-2 items-center">
                                <a href="{{ route('umkm.show', $u->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                                <a href="{{ route('umkm.edit', $u->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('umkm.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-4 text-gray-500">Belum ada data UMKM.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>