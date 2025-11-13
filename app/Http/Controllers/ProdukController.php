<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    
    public function index(Request $request)
{
    $query = Produk::with('umkm.user');

    $user = Auth::user();

    // 🧩 Kalau user biasa → hanya tampilkan produk dari UMKM miliknya
    if ($user->role === 'user') {
        $query->whereHas('umkm', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        });

        // 🔽 Filter berdasarkan UMKM milik user
        if ($request->filled('umkm_id')) {
            $query->where('umkm_id', $request->umkm_id);
        }
    }

    // 🧩 Kalau admin → bisa search semua produk
    if ($user->role === 'admin' && $request->filled('search')) {
        $query->where('nama_produk', 'like', '%' . $request->search . '%');
    }

    $produks = $query->latest()->get();

    return view('produk.index', compact('produks'));
}


    public function create()
{
    $umkms = \App\Models\Umkm::where('user_id', Auth::id())->get();
    return view('produk.create', compact('umkms'));
}


    public function store(Request $request)
{
    $request->validate([
        'umkm_id' => 'required|exists:umkms,id',
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Upload foto kalau ada
    $path = $request->file('foto') ? $request->file('foto')->store('produk', 'public') : null;

    Produk::create([
        'umkm_id' => $request->umkm_id,
        'nama_produk' => $request->nama_produk,
        'deskripsi' => $request->deskripsi,
        'harga' => $request->harga,
        'foto' => $path,
    ]);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
}

    public function edit(Produk $produk)
    {
 ;
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
{

    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'deskripsi' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }
        $produk->foto = $request->file('foto')->store('produk', 'public');
    }

    $produk->update($request->only('nama_produk', 'deskripsi', 'harga', 'foto'));

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
}

    public function destroy(Produk $produk)
    {
  

        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
