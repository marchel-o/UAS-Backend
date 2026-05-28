<h1>Daftar Category</h1>

<a href="{{ route('categories.create') }}">
    Tambah Category
</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Nama</th>
    </tr>

    @foreach ($categories as $category)

    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
    </tr>

    @endforeach

</table>