<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Bikin daftar kategori keluhan standar otomatis
        $categories = ['Fasilitas', 'Akademik', 'Kebersihan', 'Keamanan'];

        foreach ($categories as $category) {
            Category::firstOrCreate([
                'name' => $category,
            ]);
        }
    }
}