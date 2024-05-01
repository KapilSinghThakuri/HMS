<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gallery_categories')->insert([
            ['album_title' => 'Staff and Teams'],
            ['album_title' => 'Patient Care'],
            ['album_title' => 'Technology'],
            ['album_title' => 'Hospital History'],
            ['album_title' => 'Facilities'],
        ]);
    }
}
