@extends('layouts.app')

@section('content')
    <div class="flex flex-col max-w-[20rem] gap-4">
        <p class="text-xl">Halo, {{ Auth::user()->name }}</p>
        
        <button class="border-2 rounded p-2 hover:bg-gray-300 transition-colors"
            onclick="window.location.href='{{ route('tickets.create') }}'"
        >
            Buat Tiket
        </button>
    </div>
@endsection