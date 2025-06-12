<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dikirim: '#f59e0b',
                        diproses: '#3b82f6',
                        selesai: '#10b981',
                    }
                }
            }
        };
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen flex flex-col bg-gray-100">
    @include('components.navbar')

    <main class="flex-grow">
        <div class="p-6 max-w-6xl mx-auto">
            <h1 class="text-3xl font-bold text-blue-700 mb-6">📋 Daftar Pengaduan Masyarakat</h1>

            {{-- Filter & Pencarian --}}
            <form method="GET" class="flex flex-col md:flex-row md:items-center gap-4 mb-6">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul pengaduan..."
                    class="w-full md:w-1/3 px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">

                <select name="status" class="w-full md:w-1/5 px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="dikirim" {{ request('status') === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>

                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition">
                    <i class="fas fa-search mr-1"></i>Filter
                </button>
            </form>

            {{-- Tabel Pengaduan --}}
            <div class="overflow-x-auto rounded-xl shadow-md bg-white">
                <table class="min-w-full table-auto text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700 uppercase tracking-wider">
                        <tr>
                            <th class="p-4">Judul</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengaduans as $pengaduan)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-gray-800">{{ $pengaduan->judul }}</td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($pengaduan->status === 'dikirim') bg-dikirim/10 text-dikirim
                                        @elseif($pengaduan->status === 'diproses') bg-diproses/10 text-diproses
                                        @elseif($pengaduan->status === 'selesai') bg-selesai/10 text-selesai
                                        @endif
                                    ">
                                        @if($pengaduan->status === 'dikirim')
                                            <i class="fas fa-paper-plane mr-1"></i> Dikirim
                                        @elseif($pengaduan->status === 'diproses')
                                            <i class="fas fa-spinner animate-spin mr-1"></i> Diproses
                                        @else
                                            <i class="fas fa-check-circle mr-1"></i> Selesai
                                        @endif
                                    </span>
                                </td>
                                <td class="p-4 space-x-2">
                                    <a href="/admin/pengaduan/{{ $pengaduan->id }}" class="text-blue-600 hover:underline font-semibold">
                                        <i class="fas fa-eye mr-1"></i>Lihat
                                    </a>
                                    <form method="POST" action="/admin/pengaduan/{{ $pengaduan->id }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Yakin ingin menghapus pengaduan ini?')" class="text-red-600 hover:underline font-semibold">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 p-6">
                                    <i class="fas fa-inbox text-2xl mb-2"></i><br>
                                    Tidak ada pengaduan ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $pengaduans->links() }}
            </div>
        </div>
    </main>

    <footer class="bg-gray-100 border-t border-gray-200 py-6 text-center text-sm text-gray-500">
        <p>&copy; {{ date('Y') }} Sistem Pengaduan Masyarakat. Dibuat dengan ❤️ oleh Tim Instansi.</p>
        <p class="mt-1">
            <a href="#" class="text-blue-600 hover:underline">Kebijakan Privasi</a> |
            <a href="#" class="text-blue-600 hover:underline">Syarat & Ketentuan</a>
        </p>
    </footer>
</body>
</html>
