<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengaduan;
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
