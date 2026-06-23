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
    </tr>

    @foreach($faqs as $faq)
    <tr>
        <td>{{ $faq->id }}</td>
        <td>{{ $faq->question }}</td>
        <td>{{ $faq->answer }}</td>
    </tr>
    @endforeach
</table>
@endsection
