<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemateris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemateri');
            $table->string('gelar_pemateri');
            $table->text('deskripsi_pemateri');
            $table->string('gambar_pemateri')->nullable()->default('foto_pemateri/default.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemateris');
    }
};
