<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Pembimbing_Sekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class AccountSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // 'id_ps',
    // 'nip_ps',
    // 'pass_unhash',
    // 'password_ps',
    // 'nama_ps',
    // 'jk_ps',
    // 'id_jurusan',
    $faker = Faker::create('id_ID');
    $pass = Str::upper(Random::generate(8,'a-z'));
    $idJurusan = ['1003288670', '1132415814', '1640959626', '3008340035'];
    $jk = ['L', 'P'];
    for ($i=0; $i < 100; $i++) { 
      Pembimbing_Sekolah::create([
        'id_ps' => Random::generate(10, '0-9'),
        'nip_ps' => Random::generate(8, '0-9'),
        'pass_unhash' => $pass,
        'password_ps' => Hash::make($pass),
        'nama_ps' => $faker->name(),
        'jk_ps' => $jk[array_rand($jk)],
        'id_jurusan' => $idJurusan[array_rand($idJurusan)],
      ]);
    }
  }
}
