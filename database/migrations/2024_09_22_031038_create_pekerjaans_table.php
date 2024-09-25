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
    { Schema::create('pekerjaans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pekerjaan');
        $table->string('lokasi');
        $table->text('deskripsi')->nullable();
        $table->date('tanggal_mulai');
        $table->string('status');
        $table->string('subkontraktor')->nullable();
        $table->unsignedBigInteger('user_id');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pekerjaans');
    }
};
