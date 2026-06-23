@extends('layouts.app')
@section('content')
<h2>Daftar FAQ</h2>

@if(Auth::user()->role === 'admin')
<a href="{{ route('faqs.create') }}"><button>Tambah FAQ</button></a>
@endif

<br>
<br>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Pertanyaan</th>
        <th>Jawaban</th>

        @if(Auth::user()->role === 'admin')
        <th>Aksi</th>
        @endif
    </tr>

    @foreach($faqs as $faq)
    <tr>
        <td>{{ $faq->id }}</td>
        <td>{{ $faq->question }}</td>
        <td>{{ $faq->answer }}</td>
        
        
        @if(Auth::user()->role === 'admin')
        <td>
        <form action="{{ route('faqs.destroy', $faq->id) }}" method = "POST">
            @csrf 
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
        </td>
        @endif
        
    </tr>
    @endforeach
</table>
@endsection
