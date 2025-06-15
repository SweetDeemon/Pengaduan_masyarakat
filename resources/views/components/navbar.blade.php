<nav class="z-20 relative bg-white/5 backdrop-blur-lg border-b border-white/10 py-4 px-6 flex justify-between items-center text-white shadow-sm">
    <a href="/" class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-purple-500 text-transparent bg-clip-text">
        Pengaduan Masyarakat
    </a>

    <div class="space-x-4 text-sm font-medium">
        @auth
            @if(Auth::user()->role === 'user')
                <a href="/pengaduan" class="hover:text-cyan-400 transition-all duration-200">Form Pengaduan</a>
                <a href="/dashboard" class="hover:text-cyan-400 transition-all duration-200">Dashboard</a>

            @elseif(Auth::user()->role === 'admin')
                <a href="/admin" class="hover:text-cyan-400 transition-all duration-200">Dashboard Admin</a>

            @elseif(Auth::user()->role === 'instansi')
                <a href="/instansi" class="hover:text-cyan-400 transition-all duration-200">Dashboard Instansi</a>
            @endif

            <form action="/logout" method="POST" class="inline">
                @csrf
                <button class="text-red-400 hover:text-red-500 ml-2">Logout</button>
            </form>
        @else
            <a href="/login" class="hover:text-cyan-400 transition-all duration-200">Login</a>
            <a href="/register" class="hover:text-cyan-400 transition-all duration-200">Register</a>
        @endauth
    </div>
</nav>
