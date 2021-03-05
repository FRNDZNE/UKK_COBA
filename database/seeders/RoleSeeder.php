<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['admin' , 'petugas' , 'masyarakat'];

        foreach ($arr as $key => $value) {
            Role::create([
                'name' => $value,
                'display_name' => ucfirst($value),
            ]);
        }
    }
}
