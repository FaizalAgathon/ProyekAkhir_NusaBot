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
        Schema::create('pembimbing_perusahaan', function (Blueprint $table) {
          $table->string('id_pp')->primary();
          $table->string('email_pp')->unique();
          $table->string('password_pp');
          $table->string('nama_pp');
          $table->enum('jk_pp', ['L', 'P']);
          $table->string('id_perusahaan');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing_perusahaan');
    }
};
