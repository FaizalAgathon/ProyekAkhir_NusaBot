<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Perusahaan;
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
    Admin::create([
      'id_a' => Random::generate(10),
      'email_a' => 'admin@admin.com',
      'password_a' => Hash::make('12345'),
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
