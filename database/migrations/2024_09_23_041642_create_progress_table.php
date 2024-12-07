<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pekerjaan_id')->constrained()->onDelete('cascade');
            $table->string('jenis_pekerjaan')->nullable();
            $table->timestamp('tanggal_waktu_pengerjaan');
            $table->string('kondisi_cuaca')->nullable();
            $table->json('foto')->nullable();
            $table->integer('jumlah_tiang')->nullable(); 
            $table->string('status')->default('Berjalan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
