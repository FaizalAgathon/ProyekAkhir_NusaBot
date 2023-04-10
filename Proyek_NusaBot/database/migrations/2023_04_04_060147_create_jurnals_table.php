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
        Schema::create('jurnal', function (Blueprint $table) {
          $table->string('id_jurnal')->primary();
          $table->longText('kegiatan_jurnal');
          $table->longText('kompetensi_jurnal');
          $table->string('paraf_pp_jurnal')->nullable();
          $table->string('gambar_kegiatan_jurnal');
          $table->date('tanggal_jurnal');
          $table->string('id_plotting');
          $table->string('id_pp');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
