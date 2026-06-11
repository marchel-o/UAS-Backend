<?php
class PengumumanModel {
    private $db;

    public function __construct($database_connection) {
        $this->db = $database_connection;
    }

    // --- UNTUK SISI USER & ADMIN ---
    public function getAll() {
        // Mengambil semua pengumuman, urut dari yang terbaru
        $query = "SELECT * FROM pengumuman ORDER BY tanggal_rilis DESC";
        return $this->db->query($query)->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT * FROM pengumuman WHERE id = :id";
        // Eksekusi query berdasarkan ID
        return $this->db->prepare($query)->execute(['id' => $id])->fetch();
    }

    // --- KHUSUS UNTUK SISI ADMIN (CRUD) ---
    public function insert($judul, $isi, $kategori) {
        $query = "INSERT INTO pengumuman (judul, isi, kategori, tanggal_rilis) VALUES (:judul, :isi, :kategori, NOW())";
        return $this->db->prepare($query)->execute([
            'judul' => $judul,
            'isi' => $isi,
            'kategori' => $kategori
        ]);
    }

    public function update($id, $judul, $isi, $kategori) {
        $query = "UPDATE pengumuman SET judul = :judul, isi = :isi, kategori = :kategori WHERE id = :id";
        return $this->db->prepare($query)->execute([
            'id' => $id,
            'judul' => $judul,
            'isi' => $isi,
            'kategori' => $kategori
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM pengumuman WHERE id = :id";
        return $this->db->prepare($query)->execute(['id' => $id]);
    }
}