<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    // Menampilkan semua UMKM (khusus admin)
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $umkms = Umkm::with('user')->latest()->get();
        } else {
            $umkms = Umkm::where('user_id', Auth::id())->get();
        }

        return view('umkm.index', compact('umkms'));
    }

    // Form tambah UMKM
    public function create()
    {
        return view('umkm.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('umkm', 'public');
        }

        Umkm::create([
            'user_id' => Auth::id(),
            'nama_umkm' => $request->nama_umkm,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'foto' => $path,
        ]);

        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil ditambahkan!');
    }

    // Detail
    public function show(Umkm $umkm)
    {
        $this->authorizeAccess($umkm);
        return view('umkm.show', compact('umkm'));
    }

    // Form edit
    public function edit(Umkm $umkm)
    {
        $this->authorizeAccess($umkm);
        return view('umkm.edit', compact('umkm'));
    }

    // Update data
    public function update(Request $request, Umkm $umkm)
    {
        $this->authorizeAccess($umkm);

        $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kontak' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $umkm->foto;
        if ($request->hasFile('foto')) {
            if ($umkm->foto) {
                Storage::disk('public')->delete($umkm->foto);
            }
            $path = $request->file('foto')->store('umkm', 'public');
        }

        $umkm->update([
            'nama_umkm' => $request->nama_umkm,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'foto' => $path,
        ]);

        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil diperbarui!');
    }

    // Hapus data
    public function destroy(Umkm $umkm)
    {
        $this->authorizeAccess($umkm);

        if ($umkm->foto) {
            Storage::disk('public')->delete($umkm->foto);
        }

        $umkm->delete();
        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil dihapus!');
    }

    private function authorizeAccess($umkm)
    {
        if (Auth::user()->role !== 'admin' && $umkm->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini');
        }
    }
}