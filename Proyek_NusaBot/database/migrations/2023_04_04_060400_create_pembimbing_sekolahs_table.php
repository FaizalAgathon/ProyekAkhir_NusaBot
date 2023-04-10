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
      $table->bigInteger('nip_ps')->primary();
      $table->string('password_ps');
      $table->string('nama_ps');
      $table->enum('jk_ps', ['L', 'P']);
    });
    Schema::table('p_sekolah', function (Blueprint $table) {
      $table->bigInteger('id_jurusan')->constrained('jurusan', 'id_j');
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
