<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dudi_profiles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->uuid('industry_id');
            $table->foreign('industry_id')->references('id')->on('industries')->cascadeOnDelete();
            $table->string('nama_perusahaan');
            $table->string('website')->nullable();
            $table->string('telepon');
            $table->text('alamat');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dudi_profiles');
    }
};