<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lowongans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('dudi_profile_id');
            $table->foreign('dudi_profile_id')->references('id')->on('dudi_profiles')->cascadeOnDelete();
            $table->string('judul');
            $table->string('gambar')->nullable();
            $table->text('deskripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};