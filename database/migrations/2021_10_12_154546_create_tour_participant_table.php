<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_participant', function (Blueprint $table) {
            $table->id();
            $table->integer('tourId');
            $table->integer('participantId');
            $table->string('code');
            $table->dateTime('expiry');
            $table->string('status');
            $table->integer('incorrectCount')->default(0);
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
        Schema::dropIfExists('tour_participant');
    }
}
