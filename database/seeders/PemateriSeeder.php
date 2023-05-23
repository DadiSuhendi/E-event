<?php

namespace Database\Seeders;

use App\Models\Pemateri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PemateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemateri::insert([
            'nama_pemateri' => 'Dadi Suhendi',
            'gelar_pemateri' => 'Programmer',
            'deskripsi_pemateri' => '<p>Seorang yang sedang kuliah di salah satu Universitas Swasta di Banten</p>',
            'gambar_pemateri' => 'foto_pemateri/default.jpg'
        ]); 
        Pemateri::insert([
            'nama_pemateri' => 'Riyan Triadi',
            'gelar_pemateri' => 'Programmer',
            'deskripsi_pemateri' => '<p>Seorang yang sedang kuliah di salah satu Universitas Swasta di Banten</p>',
            'gambar_pemateri' => 'foto_pemateri/default.jpg'
        ]); 
    }
}
