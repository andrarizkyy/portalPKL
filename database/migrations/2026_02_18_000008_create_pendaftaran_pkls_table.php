<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pendaftaran_pkls', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->uuid('posisi_id');
            $table->foreign('posisi_id')->references('id')->on('posisis')->cascadeOnDelete();
            $table->uuid('sekolah_id');
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->cascadeOnDelete();
            $table->uuid('jurusan_id');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->cascadeOnDelete();
            $table->string('cv');
            $table->string('cover_letter')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_pkls');
    }
};