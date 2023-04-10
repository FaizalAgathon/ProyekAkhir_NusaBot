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
      $table->bigInteger('id_plotting')->primary();
    });
    Schema::table('plotting', function (Blueprint $table) {
      $table->bigInteger('nis_s')->constrained('siswa', 'nis_s');
      $table->bigInteger('nip_ps')->constrained('p_sekolah', 'nip_ps');
      $table->bigInteger('id_perusahaan')->constrained('perusahaan', 'id_p');
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
