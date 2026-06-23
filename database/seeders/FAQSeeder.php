<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FAQ::truncate();
        FAQ::create([
            'question' => 'Bagaimana cara membayar UKT?',
            'answer' => 'Pembayaran UKT dilakukan melalui virtual account pada portal akademik.'
        ]);

        FAQ::create([
            'question' => 'Bagaimana cara reset password akun kampus?',
            'answer' => 'Gunakan fitur lupa password atau hubungi IT Support.'
        ]);

        FAQ::create([
            'question' => 'Bagaimana cara mengajukan cuti kuliah?',
            'answer' => 'Pengajuan cuti dilakukan melalui bagian akademik.'
        ]);

        FAQ::create([
            'question' => 'Bagaimana cara membuat tiket pelaporan?',
            'answer' => 'Klik tombol Buat Tiket Baru, isi formulir, lalu kirim laporan.'
        ]);

        FAQ::create([
            'question' => 'Bagaimana cara melihat status tiket saya?',
            'answer' => 'Status tiket dapat dilihat pada halaman daftar tiket.'
        ]);

        FAQ::create([
            'question' => 'Apa arti status Open pada tiket?',
            'answer' => 'Status Open menunjukkan bahwa laporan telah diterima dan menunggu penanganan.'
        ]);

        FAQ::create([
            'question' => 'Apa arti status In Progress pada tiket?',
            'answer' => 'Status In Progress menunjukkan bahwa laporan sedang diproses oleh petugas terkait.'
        ]);

        FAQ::create([
            'question' => 'Apa arti status Closed pada tiket?',
            'answer' => 'Status Closed menunjukkan bahwa laporan telah selesai ditangani.'
        ]);

        FAQ::create([
            'question' => 'Bagaimana jika saya salah memilih kategori tiket?',
            'answer' => 'Buat tiket baru dengan kategori yang sesuai atau hubungi petugas terkait.'
        ]);

        FAQ::create([
            'question' => 'Berapa lama proses penanganan tiket?',
            'answer' => 'Waktu penanganan bergantung pada jenis dan tingkat prioritas laporan.'
        ]);

        FAQ::create([
            'question' => 'Siapa yang dapat melihat tiket yang saya buat?',
            'answer' => 'Tiket dapat dilihat oleh pelapor dan petugas yang bertanggung jawab menangani laporan.'
        ]);
    }
}
