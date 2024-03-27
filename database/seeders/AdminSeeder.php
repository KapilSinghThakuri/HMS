<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => 1,
            'username' => 'admin admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'),
            'address' => 'Healwave - Medical',
            'phone' => 9706934334,
        ]);
    }
}
