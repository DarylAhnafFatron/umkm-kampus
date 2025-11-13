<x-app-layout>
<div class="p-6 text-gray-900">
    <h2 class="text-2xl font-semibold mb-4">Dashboard Admin</h2>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <div class="grid grid-cols-3 gap-4 mt-6">
        <div class="bg-blue-100 p-4 rounded">
            <h3 class="font-semibold">Total UMKM</h3>
            <p class="text-3xl">{{ \App\Models\Umkm::count() }}</p>
        </div>
        <div class="bg-green-100 p-4 rounded">
            <h3 class="font-semibold">Total Produk</h3>
            <p class="text-3xl">{{ \App\Models\Produk::count() }}</p>
        </div>
        <div class="bg-purple-100 p-4 rounded">
            <h3 class="font-semibold">Total User</h3>
            <p class="text-3xl">{{ \App\Models\User::count() }}</p>
        </div>
    </div>
</div>
</x-app-layout>