<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            'nama_status' => 'terdaftar'
        ]);
        DB::table('statuses')->insert([
            'nama_status' => 'mengikuti workshop / hadir'
        ]);
        DB::table('statuses')->insert([
            'nama_status' => 'sudah claim sertifikat'
        ]);
    }
}
