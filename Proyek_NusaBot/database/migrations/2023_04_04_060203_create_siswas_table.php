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
    Schema::create('siswa', function (Blueprint $table) {
      $table->string('nis_s', 8)->primary();
      $table->string('password_s');
      $table->string('nama_s');
      $table->enum('jk_s', ['L', 'P']);
      $table->string('gambar_s')->nullable();
      $table->string('id_kelas');
      $table->string('id_jurusan');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('siswa');
  }
};
