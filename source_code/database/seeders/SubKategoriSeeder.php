<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kategoriPendidikan = Kategori::where('nama', 'Peralatan Pendidikan Sangar Kegiatan Belajar')->first();

        SubKategori::create([
            'nama' => 'Peralatan Laboratorium Bahasa',
            'kategori_id' => $kategoriPendidikan->id,
            'flag' => 'yes',
        ]);


        // Tambahkan lebih banyak subkategori sesuai kebutuhan
    }
}
