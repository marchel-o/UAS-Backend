@extends('layouts.app')

@section('content')
    <h2>Register Account</h2>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <div>
            <label>Full Name</label><br>
            <input name="full_name" type="text" value="{{ old('full_name') }}" required />
            @error('full_name') <div>{{ $message }}</div> @enderror
        </div>
        <br>

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

        <div>
            <label>Confirm Password</label><br>
            <input name="password_confirmation" type="password" required />
        </div>
        <br>

        <button type="submit">Create Account</button>
    </form>

    <br>
    <div>
        Already have an account? <a href="{{ route('login') }}">Login here</a>
    </div>
@endsection