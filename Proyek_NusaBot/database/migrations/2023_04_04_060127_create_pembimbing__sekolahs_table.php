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
        Schema::create('pembimbing_sekolah', function (Blueprint $table) {
            $table->string('nip_ps', 8)->primary();
            $table->string('password_ps');
            $table->string('nama_ps');
            $table->enum('jk_ps', ['L', 'P']);
            $table->string('id_jurusan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembimbing_sekolah');
    }
};
