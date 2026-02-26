<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lowongan_jurusan', function (Blueprint $table) {
            $table->uuid('lowongan_id');
            $table->uuid('jurusan_id');
            $table->foreign('lowongan_id')->references('id')->on('lowongans')->cascadeOnDelete();
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->cascadeOnDelete();
            $table->primary(['lowongan_id', 'jurusan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan_jurusan');
    }
};