<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Kategori::create([
            'nama' => 'Peralatan Pendidikan Sangar Kegiatan Belajar',
            'flag' => 'yes',
        ]);
        // Tambahkan lebih banyak kategori sesuai kebutuhan
    }
}
