<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourPartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_partner', function (Blueprint $table) {
            $table->id();
            $table->integer('tourId');
            $table->integer('partnerId');
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
        Schema::dropIfExists('tour_partner');
    }
}
