<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipalityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $muniType = "INSERT INTO `municipality_types` VALUES
        (1, 'महानगरपालिका', NULL, NULL),
        (2, 'उपमहानगरपालिका', NULL, NULL),
        (3, 'नगरपालिका', NULL, NULL),
        (4, 'गाउँपालिका', NULL, NULL)";

        DB::select(DB::raw($muniType));
    }
}
