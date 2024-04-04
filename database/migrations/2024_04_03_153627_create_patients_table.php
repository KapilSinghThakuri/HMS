<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->enum('gender',['male','female','other']);
            $table->date('date_of_birth');
            $table->string('temporary_address')->nullable();
            $table->string('permanent_address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('parents_name')->nullable();
            $table->string('appointment_message')->nullable();
            $table->string('medical_history')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
