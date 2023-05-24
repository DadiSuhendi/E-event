<?php

namespace Database\Seeders;

use App\Models\Status;
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
        Status::insert([
            'status' => 'terdaftar'
        ]);
        Status::insert([
            'status' => 'hadir'
        ]);
        Status::insert([
            'status' => 'sudah klaim sertifikat'
        ]);
    }
}
