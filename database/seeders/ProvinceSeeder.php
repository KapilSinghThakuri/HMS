<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            'Koshi',
            'Madhesh',
            'Bagmati',
            'Gandaki',
            'Lumbini',
            'Karnali',
            'Sudurpashchim',
        ];
        $data = array_map(function ($province) {
            return ['province_name' => $province];
        }, $provinces);

        DB::table('provinces')->insert($data);
    }
}
