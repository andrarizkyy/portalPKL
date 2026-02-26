<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siswa_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->uuid('sekolah_id');
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->cascadeOnDelete();
            $table->uuid('jurusan_id');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->cascadeOnDelete();
            $table->string('nis');
            $table->string('phone');
            $table->enum('gender', ['L', 'P']);
            $table->text('address');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa_profiles');
    }
};