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
    Schema::create('p_sekolah', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->bigInteger('id_ps')->unique();
      $table->bigInteger('nip_ps')->unique();
      $table->string('pass_unhash');
      $table->string('password_ps');
      $table->string('nama_ps');
      $table->enum('jk_ps', ['L', 'P']);
      $table->bigInteger('id_jurusan');
      $table->timestamps();
    });
    Schema::table('p_sekolah', function (Blueprint $table) {
      $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->restrictOnUpdate()->restrictOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    // Schema::hasTable('p_sekolah', function (Blueprint $table) {
    //   $table->dropIndex('psekolah_id_jurusan_foreign');
    // });
    Schema::dropIfExists('p_sekolah');
  }
};
