<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->insert([
            [
                'model_name' => 'Department',
                'slug' => Str::slug('model_name'),
                'model_link' => '/Healwave/department',
            ],
            [
                'model_name' => 'Gallery',
                'slug' => Str::slug('model_name'),
                'model_link' => '/Healwave/gallery',
            ],
        ]);
    }
}
