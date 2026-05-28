@extends('layouts.app')

@section('content')
    <h2>Daftar Kategori Masalah</h2>
    <a href="{{ route('categories.create') }}"><button>+ Tambah Kategori Baru</button></a>
    <br><br>

    <table border="1" cellpadding="8" style="border-collapse: collapse; width: 100%;">
        <thead style="background-color: #f4f4f4;">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" align="center">Belum ada kategori. Silakan tambah baru.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection