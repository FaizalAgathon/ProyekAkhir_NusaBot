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
    Schema::create('plotting', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->bigInteger('id_plotting')->unique();
      $table->bigInteger('id_siswa');
      $table->bigInteger('id_ps');
      $table->bigInteger('id_perusahaan');
      $table->timestamps();
    });
    Schema::table('plotting', function (Blueprint $table) {      
      $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->restrictOnUpdate()->restrictOnDelete();
      $table->foreign('id_ps')->references('id_ps')->on('p_sekolah')->restrictOnUpdate()->restrictOnDelete();
      $table->foreign('id_perusahaan')->references('id_perusahaan')->on('perusahaan')->restrictOnUpdate()->restrictOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('plotting');
  }
};
