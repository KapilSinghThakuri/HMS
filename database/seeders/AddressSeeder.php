<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PragmaRX\Countries\Package\Countries;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $districts = collect([
            'achham', 'arghakhanchi', 'baglung', 'baitadi', 'bajhang', 'bajura', 'banke', 'bara',
            'bardiya', 'bhaktapur', 'bhojpur', 'chitwan', 'dadeldhura', 'dailekh', 'dang deukhuri',
            'darchula', 'dhading', 'dhankuta', 'dhanusa', 'dholkha', 'dolpa', 'doti', 'gorkha',
            'gulmi', 'humla', 'ilam', 'jajarkot', 'jhapa', 'jumla', 'kailali', 'kalikot', 'kanchanpur',
            'kapilvastu', 'kaski', 'kathmandu', 'kavrepalanchok', 'khotang', 'lalitpur', 'lamjung',
            'mahottari', 'makwanpur', 'manang', 'morang', 'mugu', 'mustang', 'myagdi', 'nawalparasi',
            'nuwakot', 'okhaldhunga', 'palpa', 'panchthar', 'parbat', 'parsa', 'pyuthan', 'ramechhap',
            'rasuwa', 'rautahat', 'rolpa', 'rukum', 'rupandehi', 'salyan', 'sankhuwasabha', 'saptari',
            'sarlahi', 'sindhuli', 'sindhupalchok', 'siraha', 'solukhumbu', 'sunsari', 'surkhet', 'syangja',
            'tanahu', 'taplejung', 'terhathum', 'udayapur', 'nawalpur'
        ]);

        $districtsArray = $districts->map(function ($district) {
            return ['district_name' => $district];
        })->all();

        foreach ($districtsArray as $value) {
            DB::table('districts')->insert($value);
        }
    }
}
