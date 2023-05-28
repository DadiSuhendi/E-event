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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('tipe');
            $table->string('judul');
            $table->string('slug');
            $table->string('gambar')->nullable()->default('foto_event/default.jpg');
            $table->text('deskripsi');
            $table->string('tanggal');
            $table->string('tanggal_selesai')->nullable();
            $table->string('jam');
            $table->string('harga');
            $table->string('status')->default('nonaktif');
            $table->enum('status_event', ['selesai', 'belum_selesai'])->default('belum_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
