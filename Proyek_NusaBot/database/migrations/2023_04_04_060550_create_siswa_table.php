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
      $table->bigInteger('nis_siswa')->unique();
      $table->string('password_s');
      $table->string('nama_s');
      $table->enum('jk_s', ['L', 'P']);
      $table->string('gambar_s')->nullable();
      $table->bigInteger('id_kelas');
      $table->bigInteger('id_jurusan');
      $table->timestamps();
    });
    Schema::table('siswa', function (Blueprint $table) {
      $table->foreign('id_kelas', 'fk_siswa_kelas')->references('id_kelas')->on('kelas')->restrictOnUpdate()->restrictOnDelete();
      $table->foreign('id_jurusan', 'fk_siswa_jurusan')->references('id_jurusan')->on('jurusan')->restrictOnUpdate()->restrictOnDelete();
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
