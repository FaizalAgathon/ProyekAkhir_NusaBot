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
    Schema::create('p_perusahaan', function (Blueprint $table) {
      $table->engine = 'InnoDB';
      $table->bigInteger('id_pp')->primary();
      $table->string('email_pp')->unique();
      $table->string('password_pp');
      $table->string('nama_pp');
      $table->enum('jk_pp', ['L', 'P']);
      $table->timestamps();
    });
    Schema::table('p_perusahaan', function (Blueprint $table) {
      $table->bigInteger('id_perusahaan')->constrained('perusahaan', 'id_p');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('p_perusahaan');
  }
};
