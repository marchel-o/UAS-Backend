<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Tiket Kampus</title>
</head>
<body>
    <nav>
        <strong>Sistem Tiket Kampus</strong> | 
        @auth
            Halo, {{ ucwords(Auth::user()->full_name) }}! | 
            <a href="{{ route('tickets.index') }}">Beranda Tiket</a> |
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

    @if(session('success'))
        <div>
            <strong>Sukses:</strong> {{ session('success') }}
        </div>
        <hr>
    @endif

    @yield('content')

</body>
</html>