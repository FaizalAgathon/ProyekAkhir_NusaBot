<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Pembimbing_Perusahaan;
use App\Models\Pembimbing_Sekolah;
use App\Models\Perusahaan;
use App\Models\Siswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Faker\Factory as Faker;

class GeneralSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  
  public function run(): void
  {
    $angkatan = ['10', '11', '12', '13'];
    $faker = Faker::create('id_ID');
    $jurusan = ['RPL1', 'RPL2', 'TKJ1', 'TKJ2'];
    // Admin::create([
    //   'id_a' => Random::generate(10),
    //   'email_a' => 'admin@admin.com',
    //   'password_a' => Hash::make('12345'),
    // ]);
    // Siswa::create([
    //   'nis_s' => '12345678',
    //   'password_s' => Hash::make('12345'),
    //   'password_s' => Hash::make('12345'),
    //   'password_s' => Hash::make('12345'),
    // ]);
    Jurusan::create([
      'id_j' => Random::generate(8, '0-9'),
      'nama_j' => 'RPL'
    ]);
    Pembimbing_Sekolah::create([
      'nip_ps' => '12345678',
      'password_ps' => Hash::make('12345'),
      'nama_ps' => 'IZAL',
      'jk_ps' => 'L',
    ]);
    Pembimbing_Perusahaan::create([
      'id_pp' => Random::generate(10),
      'email_pp' => 'pp@pp.com',
      'password_pp' => Hash::make('12345'),
    ]);
    // for ($i=0; $i < sizeof($this->jurusan); $i++) { 
    //   Jurusan::create([
    //     'id_j' => Random::generate(10),
    //     'nama_j' => $this->jurusan[array_rand($this->jurusan)],
    //   ]);
    // }
    // for ($i=0; $i < sizeof($this->angkatan); $i++) { 
    //   Kelas::create([
    //     'id_k' => Random::generate(10),
    //     'angkatan_k' => $this->angkatan[array_rand($this->angkatan)],
    //   ]);
    // }
    // for ($i=0; $i < 10; $i++) { 
    //   Perusahaan::create([
    //     'id_p' => Random::generate(10),
    //     'nama_p' => $this->faker->company,
    //     'alamat_p' => $this->faker->address,
    //   ]);
    // }
  }
}
