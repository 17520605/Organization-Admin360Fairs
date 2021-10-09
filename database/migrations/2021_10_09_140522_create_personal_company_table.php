<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_company', function (Blueprint $table) {
            $table->id();
            $table->integer('accountId')->nullable();
            $table->string('avatar')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('website')->nullable();
            $table->string('profile')->nullable();
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
        Schema::dropIfExists('personal_company');
    }
}
