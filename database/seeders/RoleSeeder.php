<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = [
            'admin',
            'doctor',
            'staff',
            'patient'
        ];
        foreach ($name as $value) {
            DB::table('roles')->insert([
                'name' => $value,
            ]);
        }
    }
}
