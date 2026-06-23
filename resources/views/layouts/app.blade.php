<!DOCTYPE html>
<html lang="id">
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <nav style="display: flex; align-items: center; gap: 1rem;">
            <strong>Sistem Tiket Kampus</strong> | 
            @auth
                <p style="margin: 0;">Halo, {{ ucwords(Auth::user()->full_name) }}!</p> | 
                
                <a href="{{ route('tickets.index') }}">Beranda Tiket</a> |
                <a href="{{ route('dashboard.index') }}">Dashboard</a> |
                
                @if(Auth::user()->role === 'admin') 
                    <a href="{{ route('categories.index') }}">Kelola Kategori</a> | 
                @endif
                
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('announcements.admin') }}">Kelola Pengumuman</a> |
                @else
                    <a href="{{ route('announcements.index') }}">Info Kampus</a> |
                @endif

                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('users.index') }}">Kelola Pengguna</a> |
                @endif

                <a href="{{ route('faqs.index') }}">FAQ</a> |
                
                <a href="{{ route('profile.index') }}">Pengaturan</a> | 
                <a href="{{ route('contact') }}">Kontak Bantuan</a> |
                
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

        @if(session('error'))
            <div style="color: red; background-color: #fce4d6; padding: 10px; margin-bottom: 10px;">
                <strong>Error:</strong> {{ session('error') }}
            </div>
            <hr>
        @endif

        @if(session('success'))
            <div>
                <strong>Sukses:</strong> {{ session('success') }}
            </div>
            <hr>
        @endif

        @yield('content')

    </body>
</html>