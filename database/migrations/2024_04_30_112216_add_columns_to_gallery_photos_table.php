<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToGalleryPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('gallery_photos', function (Blueprint $table) {
        //     $table->string('file_type')->after('photos');
        //     $table->integer('display_order')->after('id');
        //     $table->enum('status', ['active', 'Inactive'])->after('file_type');
        // });

        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->integer('display_order')->after('id');
            $table->enum('status', ['active', 'Inactive'])->after('album_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('gallery_photos', function (Blueprint $table) {
        //     $table->dropColumn('file_type');
        //     $table->dropColumn('display_order');
        //     $table->dropColumn('status');
        // });
        Schema::table('gallery_categories', function (Blueprint $table) {
            $table->dropColumn('display_order');
            $table->dropColumn('status');
        });
    }
}
