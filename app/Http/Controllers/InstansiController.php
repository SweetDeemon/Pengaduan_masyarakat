<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class InstansiController extends Controller
{
    /**
     * Menampilkan daftar pengaduan berdasarkan status.
     */
    public function index(Request $request)
    {
        $query = Pengaduan::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        } else {
            $query->whereIn('status', ['dikirim', 'diproses', 'selesai']);
        }

        $pengaduans = $query->latest()->paginate(10)->appends(request()->query()); // Pagination

        return view('instansi.index', compact('pengaduans'));
    }

    /**
     * Menyimpan tanggapan instansi ke pengaduan.
     */
    public function tanggapi(Request $request, $id)
    {
        $request->validate([
            'tanggapan' => 'required|string',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->tanggapan) {
            return back()->with('error', 'Tanggapan sudah diberikan.');
        }

        $pengaduan->tanggapan = $request->tanggapan;

        if (in_array($pengaduan->status, ['dikirim', 'pending'])) {
            $pengaduan->status = 'diproses';
        }

        $pengaduan->save();

        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }

    /**
     * Mengubah status pengaduan menjadi selesai.
     */
    public function setSelesai($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        if ($pengaduan->status === 'diproses') {
            $pengaduan->status = 'selesai';
            $pengaduan->save();

            return redirect('/instansi')->with('success', 'Pengaduan berhasil diselesaikan.');
        }

        return redirect('/instansi')->with('error', 'Pengaduan tidak dalam status diproses.');
    }

    /**
     * Menampilkan detail pengaduan.
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        return view('instansi.show', compact('pengaduan'));
    }

    /**
     * Menampilkan form edit pengaduan (hanya jika status masih "dikirim").
     */
    public function edit($id)
    {
        $pengaduan = Pengaduan::where('status', 'dikirim')->findOrFail($id);
        return view('instansi.edit', compact('pengaduan'));
    }

    /**
     * Menyimpan perubahan data pengaduan.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
        ]);

        $pengaduan = Pengaduan::where('status', 'dikirim')->findOrFail($id);
        $pengaduan->update($request->only('judul', 'isi'));

        return redirect('/instansi')->with('success', 'Pengaduan berhasil diperbarui.');
    }

    /**
     * Menghapus pengaduan (hanya jika status masih "dikirim").
     */
    public function destroy($id)
    {
        $pengaduan = Pengaduan::where('status', 'dikirim')->findOrFail($id);
        $pengaduan->delete();

        return back()->with('success', 'Pengaduan berhasil dihapus.');
    }
}
