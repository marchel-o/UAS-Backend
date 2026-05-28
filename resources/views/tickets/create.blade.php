<h1>Buat Tiket Baru</h1>
<form action="{{ route('tickets.store') }}" method="POST">
    @csrf
    <label>Judul:</label><br>
    <input type="text" name="title" required><br><br>
    
    <label>Deskripsi:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Prioritas:</label><br>
    <select name="priority">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
        <option value="urgent">Urgent</option>
    </select><br><br>

    <button type="submit">Simpan Tiket</button>
</form>