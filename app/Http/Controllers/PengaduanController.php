<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // Form kirim pengaduan
    public function index()
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())->get();
        return view('user.form_pengaduan', compact('pengaduan'));
    }

    // Dashboard user: riwayat pengaduan
public function dashboard(Request $request)
{
    $query = Pengaduan::where('user_id', auth()->id());

    // Filter pencarian berdasarkan judul
    if ($request->filled('search')) {
        $query->where('judul', 'like', '%' . $request->search . '%');
    }

    // Filter berdasarkan status (jika dipilih)
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $pengaduans = $query->orderBy('created_at', 'desc')->paginate(5);

    return view('user.dashboard', compact('pengaduans'));
}


    // Simpan pengaduan baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan', 'public');
        }

        Pengaduan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $fotoPath,
            'status' => 'dikirim',
        ]);

        return back()->with('success', 'Pengaduan berhasil dikirim.');
    }

    // Menampilkan detail pengaduan user
    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.detail', compact('pengaduan'));
    }
}
