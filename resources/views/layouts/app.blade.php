<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Tiket Kampus</title>
</head>
<body>
    <nav>
        <strong>Sistem Tiket Kampus</strong> | 
        @auth
            Halo, {{ ucwords(Auth::user()->full_name ?? Auth::user()->name) }}! | 
            <a href="{{ route('tickets.index') }}">Beranda Tiket</a> |
            <a href="{{ route('categories.index') }}">Kelola Kategori</a> | 
            
            {{-- PERBAIKAN NAVIGASI: Memisahkan Menu Berdasarkan Role --}}
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('announcements.admin') }}" style="font-weight: bold; color: blue;">Kelola Pengumuman (Admin)</a> |
            @else
                <a href="{{ route('announcements.index') }}">Info Kampus</a> |
            @endif
            
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a> | 
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>
    
    <hr>

    {{-- Alert untuk pesan sukses --}}
    @if(session('success'))
        <div style="color: green; background-color: #e2f0d9; padding: 10px; margin-bottom: 10px;">
            <strong>Sukses:</strong> {{ session('success') }}
        </div>
        <hr>
    @endif

    {{-- Alert untuk pesan error (Penting untuk memunculkan proteksi tiket yang kita buat tadi) --}}
    @if(session('error'))
        <div style="color: red; background-color: #fce4d6; padding: 10px; margin-bottom: 10px;">
            <strong>Error:</strong> {{ session('error') }}
        </div>
        <hr>
    @endif

    @yield('content')

</body>
</html>