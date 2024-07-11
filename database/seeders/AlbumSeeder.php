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
            ['album_title' => 'Staff and Teams', 'display_order' => 1],
            ['album_title' => 'Patient Care', 'display_order' => 2],
            ['album_title' => 'Technology', 'display_order' => 3],
            ['album_title' => 'Hospital History', 'display_order' => 4],
            ['album_title' => 'Facilities', 'display_order' => 5],
        ]);
    }
}
