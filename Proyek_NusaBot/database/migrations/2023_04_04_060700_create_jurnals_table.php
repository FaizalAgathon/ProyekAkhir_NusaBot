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
      $table->engine = 'InnoDB';
      $table->bigInteger('id_jurnal')->unique();
      $table->longText('kegiatan_jurnal');
      $table->longText('kompetensi_jurnal');
      $table->string('paraf_pp_jurnal')->nullable();
      $table->string('gambar_kegiatan_jurnal');
      $table->date('tanggal_jurnal');
      $table->bigInteger('id_plotting');
      $table->bigInteger('id_pp')->nullable();
      $table->timestamps();
    });
    Schema::table('jurnal', function (Blueprint $table) {
      $table->foreign('id_plotting')->references('id_plotting')->on('plotting')->restrictOnUpdate()->restrictOnDelete();
      $table->foreign('id_pp')->references('id_pp')->on('p_perusahaan')->restrictOnUpdate()->restrictOnDelete();
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
