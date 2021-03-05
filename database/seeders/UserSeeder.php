<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        $admin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('rahasia'),
        ]);

        $admin->attachRole('admin');

        //Petugas
        $petugas = User::create([
            'name' => 'Petugas 1',
            'username' => 'petugas1',
            'password' => bcrypt('rahasia'),
            'telp' => '081256340987',
        ]);

        $petugas->attachRole('petugas');

    }
}
