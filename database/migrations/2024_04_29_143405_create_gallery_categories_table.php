<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('album title');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->softDeletes()->after('created_at');
        });
        Schema::table('user_feedback', function (Blueprint $table) {
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
        Schema::dropIfExists('gallery_categories');

        Schema::table('pages', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('user_feedback', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
