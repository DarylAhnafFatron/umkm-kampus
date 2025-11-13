<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard UMKM') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900">
    Halo <b>{{ Auth::user()->name }}</b>! Anda login sebagai <b>Pengelola UMKM</b>.

    <div class="mt-4">
        <a href="{{ route('umkm.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Lihat / Kelola UMKM Saya
        </a>
    </div>
</div>

</x-app-layout>
