@extends('layouts.app')

@section('content')
    <form method="POST" action='{{ route("user.login") }}'>
        @csrf

        <p class="text-[1.5rem]">Login</p>
        <label>Email</label>
        <input class="border rounded" value="{{ old('email') }}"
            name='email' type='email' required
        />
        
        <label>Password</label>
        <input class="border rounded"
            name='password' required
        />

        <button class="border-2 rounded p-2 hover:bg-green-300 transition-colors"
            type="submit"
        >
            Login
        </button>
        
        <p>Dont have an account? Click <a href="/register" class="text-blue-700 underline">here</a></p>

        @if($errors->any())
            <p>Error!</p>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </form>
@endsection