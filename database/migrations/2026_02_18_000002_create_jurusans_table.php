<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jurusans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('sekolah_id');
            $table->foreign('sekolah_id')->references('id')->on('sekolahs')->cascadeOnDelete();
            $table->string('nama');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurusans');
    }
};