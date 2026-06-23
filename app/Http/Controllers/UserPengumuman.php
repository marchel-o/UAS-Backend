<?php
class UserPengumuman {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    // Menampilkan semua pengumuman di mading kampus
    public function index() {
        $pengumuman = $this->model->getAll();
        include 'views/user/list.php'; // Lempar data ke view user
    }

    // Menampilkan detail satu pengumuman saat diklik
    public function detail($id) {
        $info = $this->model->getById($id);
        include 'views/user/detail.php';
    }
}