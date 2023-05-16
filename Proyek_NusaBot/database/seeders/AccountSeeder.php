<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use App\Models\Pembimbing_Sekolah;
use App\Models\Siswa;
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
    $idJurusan = ['1003288670', '1132415814', '1640959626', '3008340035'];
    $idAngkatan = ['1534794530', '2316676399', '2770317116', '5191192188'];
    $jk = ['L', 'P'];
    for ($i = 0; $i < 100; $i++) {
      $pass = Str::upper(Random::generate(8, 'a-z'));
      // Pembimbing_Sekolah::create([
      //   'id_ps' => Random::generate(10, '0-9'),
      //   'nip_ps' => Random::generate(8, '0-9'),
      //   'pass_unhash' => $pass,
      //   'password_ps' => Hash::make($pass),
      //   'nama_ps' => $faker->name(),
      //   'jk_ps' => $jk[array_rand($jk)],
      //   'id_jurusan' => $idJurusan[array_rand($idJurusan)],
      // ]);
      // Siswa::create([
      //   'id_siswa' => Random::generate(10, '0-9'),
      //   'nis_siswa' => Random::generate(8, '0-9'),
      //   'pass_unhash' => $pass,
      //   'password_s' => Hash::make($pass),
      //   'nama_s' => $faker->name(),
      //   'jk_s' => $jk[array_rand($jk)],
      //   'gambar_s' => 'noImgProfile.png',
      //   'id_kelas' => $idAngkatan[array_rand($idAngkatan)],
      //   'id_jurusan' => $idJurusan[array_rand($idJurusan)],
      // ]);
    }
  }
}
