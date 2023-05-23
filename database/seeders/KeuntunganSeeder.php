<?php

namespace Database\Seeders;

use App\Models\Keuntungan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeuntunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Keuntungan::insert([
            'keuntungan' => 'Mendapatkan Relasi',
        ]); 
        Keuntungan::insert([
            'keuntungan' => 'Mendapatkan Sertifikat Online',
        ]); 
    }
}
