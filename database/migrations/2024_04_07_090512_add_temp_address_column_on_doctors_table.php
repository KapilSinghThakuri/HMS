<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTempAddressColumnOnDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->foreignId('temp_country_id')->nullable()->constrained('countries');
            $table->foreignId('temp_province_id')->nullable()->constrained('provinces');
            $table->foreignId('temp_district_id')->nullable()->constrained('districts');
            $table->foreignId('temp_municipality_id')->nullable()->constrained('municipalities');
            $table->string('temp_street')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['temp_country_id']);
            $table->dropForeign(['temp_province_id']);
            $table->dropForeign(['temp_district_id']);
            $table->dropForeign(['temp_municipality_id']);
            $table->dropColumn(['temp_country_id', 'temp_province_id', 'temp_district_id', 'temp_municipality_id', 'temp_street']);
        });
    }
}
