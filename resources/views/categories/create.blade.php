<h1>Tambah Category</h1>

<form action="{{ route('categories.store') }}" method="POST">

    @csrf

    <input type="text" name="name">

    <button type="submit">
        Simpan
    </button>

</form>