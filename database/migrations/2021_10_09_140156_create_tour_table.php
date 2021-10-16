<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour', function (Blueprint $table) {
            $table->id();
            $table->integer('organizerId')->nullable();
            $table->integer('overviewId')->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('startTime')->nullable();
            $table->dateTime('endTime')->nullable();
            $table->integer('maximumZone')->nullable()->default(10);
            $table->integer('maximumBooth')->nullable()->default(30);
            $table->integer('maximumPanorama')->nullable()->default(50);
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
        Schema::dropIfExists('tour');
    }
}
