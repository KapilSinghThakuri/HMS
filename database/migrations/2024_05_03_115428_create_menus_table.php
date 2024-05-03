<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('display_order');

            $table->integer('menu_type_id');

            $table->foreignId('parent_id')->constrained('menus')->nullable();

            $table->foreignId('model_id')->constrained('modules')->nullable();

            $table->foreignId('page_id')->constrained('pages')->nullable();

            $table->json('menu_name');

            $table->string('external_link')->nullable();

            $table->boolean('status')->comment('1 = active, 0 = inactive');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
