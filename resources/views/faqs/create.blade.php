@extends('layouts.app')
@section('content')
<h2>Tambah FAQ</h2>
<form action="{{ route('faqs.store') }}" method = "POST">
    @csrf
    <div>
        <label>Pertanyaan</label>
        <br><input type = "text" name ="question">
    </div>
    <br>

    <div>
        <label>Jawaban</label>
        <br><textarea name= "answer"></textarea>
    </div>
    <br>

    <button type="Submit">Simpan</button>
</form>
@endsection