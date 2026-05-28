@extends('layouts.app')

@section('content')
    <div class="">
        <p class="text-xl">Hi</p>
        
        <button class="border-2 rounded p-2 hover:bg-gray-300 transition-colors"
            onclick="window.location.href='{{ route('tickets.create') }}'"
        >
            Make a ticket
        </button>
    </div>
@endsection