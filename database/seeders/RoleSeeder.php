<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Administrator',
            'Doctor',
            'staff',
            'patient'
        ];
        foreach ($names as $value) {
            Role::create([
                'name' => $value,
                'guard_name' => 'web',
            ]);
        }
    }
}
