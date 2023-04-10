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
      $table->engine = 'InnoDB';
      $table->bigInteger('nis_s')->primary();
      $table->string('password_s');
      $table->string('nama_s');
      $table->enum('jk_s', ['L', 'P']);
      $table->string('gambar_s')->nullable();
      $table->timestamps();
    });
    Schema::table('siswa', function (Blueprint $table) {
      $table->bigInteger('id_kelas')->constrained('kelas', 'id_k');
      $table->bigInteger('id_jurusan')->constrained('jurusan', 'id_j');
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
