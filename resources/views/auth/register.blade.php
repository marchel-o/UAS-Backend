@extends('layouts.app')

@section('content')
    <form method="POST" action='{{ route("user.register") }}'>
        @csrf

        <p class="text-[1.5rem]">Register</p>
        <label>Email</label>
        <input class="border rounded"
            name='email' type='email' required
        />

        <label>Name</label>
        <input class="border rounded"
            name='name' required maxlength=100 
        />
        
        <label>Password</label>
        <input class="border rounded"
            name='password' required
        />

        <button class="border rounded p-2 hover:bg-green-400 transition-colors"
            type="submit"
        >
            Create Account
        </button>

        <p>Already have an account? Click <a href="/login" class="text-blue-700 underline">here</a></p>

        @if($errors->any())
            <p>Error!</p>
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </form>
@endsection