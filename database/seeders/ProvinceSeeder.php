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
        $rows = [
            [
                'province_name[nep]' => 'प्रदेश नं. १',
                'province_name[eng]' => 'Province No. 1',
            ],
            [
                'province_name[nep]' => 'मधेश प्रदेश',
                'province_name[eng]' => 'Madhesh',
            ],
            [
                'province_name[nep]' => 'बााग्मती प्रदेश',
                'province_name[eng]' => 'Bagmati',
            ],
            [
                'province_name[nep]' => 'गण्डकी प्रदेश',
                'province_name[eng]' => 'Gandaki',
            ],
            [
                'province_name[nep]' => 'लुम्बिनि प्रदेश',
                'province_name[eng]' => 'Lumbini',
            ],
            [
                'province_name[nep]' => 'कर्णाली प्रदेश',
                'province_name[eng]' => 'Karnali',
            ],
            [
                'province_name[nep]' => 'सुदुरपश्चिम प्रदेश',
                'province_name[eng]' => 'Sudurpaschim',
            ]
        ];
        DB::table('provinces')->insert($rows);
    }
}
