<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipe_user')->insert([
            'nama' => 'super admin'
        ]);

        DB::table('tipe_user')->insert([
            'nama' => 'admin'
        ]);

        DB::table('tipe_user')->insert([
            'nama' => 'mahasiswa'
        ]);

        DB::table('user')->insert([
            'nama' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin'),
            'status' => 1,
            'tipe_user_id' => 1
        ]);

        DB::table('user')->insert([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'status' => 1,
            'tipe_user_id' => 2
        ]);

        DB::table('user')->insert([
            'nama' => 'Bima Kurnia Adam',
            'email' => 'nggocal@gmail.com',
            'password' => Hash::make('bimakurniaadam'),
            'status' => 1,
            'tipe_user_id' => 3
        ]);

        DB::table('user')->insert([
            'nama' => 'Nicholas Sumardi',
            'email' => 'rokudo500@gmail.com',
            'password' => Hash::make('nicholassumardi'),
            'status' => 1,
            'tipe_user_id' => 3
        ]);

        DB::table('admin')->insert([
            'nama' => 'Admin Nicholas',
            'umur' => 21,
            'alamat' => 'Grand Delta Sari',
            'kota' => 'Sidoarjo',
            'negara' => 'Indonesia',
            'user_id' => 2
        ]);

        DB::table('mahasiswa')->insert([
            'nama' => 'Bima Kurnia Adam',
            'umur' => 21,
            'npm' => '06.2018.1.07053',
            'alamat' => 'Delta Sari Indah AH-2',
            'kota' => 'Sidoarjo',
            'negara' => 'Indonesia',
            'user_id' => 3
        ]);

        DB::table('mahasiswa')->insert([
            'nama' => 'Nicholas Sumardi',
            'umur' => 21,
            'npm' => '06.2018.1.06977',
            'alamat' => 'Grand Delta Sari',
            'kota' => 'Sidoarjo',
            'negara' => 'Indonesia',
            'user_id' => 4
        ]);
    }
}
