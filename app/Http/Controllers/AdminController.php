<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengaduan::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pengaduans = $query->latest()->paginate(10);

        return view('admin.index', compact('pengaduans'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.detail', compact('pengaduan'));
    }

    public function edit($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('admin.edit', compact('pengaduan'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $pengaduan->judul = $request->judul;
        $pengaduan->isi = $request->isi;

        if ($request->hasFile('foto')) {
            if ($pengaduan->foto) {
                Storage::disk('public')->delete($pengaduan->foto);
            }

            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
            $pengaduan->foto = $fotoPath;
        }

        $pengaduan->save();

        return redirect()->route('admin.dashboard')->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        
        if ($pengaduan->foto) {
            Storage::disk('public')->delete($pengaduan->foto);
        }

        $pengaduan->delete();

        return redirect('/admin')->with('success', 'Pengaduan berhasil dihapus.');
    }
}
