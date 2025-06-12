<nav class="bg-white shadow-md py-4 px-6 flex justify-between items-center mb-6">
    <a href="/" class="text-xl font-bold text-blue-600">Pengaduan Masyarakat</a>
    <div class="space-x-4">
        @auth
@if(Auth::user()->role === 'user')
    <a href="/pengaduan" class="text-gray-700 hover:text-blue-600">Form Pengaduan</a>
    <a href="/dashboard" class="text-gray-700 hover:text-blue-600">Dashboard</a>
            @elseif(Auth::user()->role === 'admin')
                <a href="/admin" class="text-gray-700 hover:text-blue-600">Dashboard Admin</a>
            @elseif(Auth::user()->role === 'instansi')
                <a href="/instansi" class="text-gray-700 hover:text-blue-600">Dashboard Instansi</a>
            @endif
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        @else
            <a href="/login" class="text-gray-700 hover:text-blue-600">Login</a>
            <a href="/register" class="text-gray-700 hover:text-blue-600">Register</a>
        @endauth
    </div>
</nav>
