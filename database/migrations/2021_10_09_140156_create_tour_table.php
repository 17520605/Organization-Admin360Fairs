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
            $table->string('description');
            $table->date('startTime')->nullable();
            $table->date('endTime')->nullable();
            $table->integer('maximumZone')->nullable();
            $table->integer('maximumBooth')->nullable();
            $table->integer('maximumPanorama')->nullable();
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
