@extends('layouts.app')

@section('content')
    <h2>Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label>Email</label><br>
            <input name="email" type="email" value="{{ old('email') }}" required />
            @error('email') <div>{{ $message }}</div> @enderror
        </div>
        <br>

        <div>
            <label>Password</label><br>
            <input name="password" type="password" required />
            @error('password') <div>{{ $message }}</div> @enderror
        </div>
        <br>

        <button type="submit">Login</button>
    </form>

    <br>
    <div>
        Don't have an account? <a href="{{ route('register') }}">Register here</a>
    </div>
@endsection