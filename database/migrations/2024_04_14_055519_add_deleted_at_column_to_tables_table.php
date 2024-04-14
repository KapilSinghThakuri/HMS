<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtColumnToTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->softDeletes()->after('created_at');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes()->after('created_at');
        });
        Schema::table('education', function (Blueprint $table) {
            $table->softDeletes()->after('created_at');
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->softDeletes()->after('created_at');
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
            $table->dropSoftDeletes();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('education', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
