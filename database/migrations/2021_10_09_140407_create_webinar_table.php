<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webinar', function (Blueprint $table) {
            $table->id();
            $table->integer('tourId')->nullable();
            $table->integer('registerBy')->nullable();
            $table->string('topic');
            $table->dateTime('startAt');
            $table->dateTime('endAt');
            $table->string('zoom');
            $table->string('description');
            $table->boolean('isDeleted')->default(0);
            $table->boolean('isConfirmed')->default(NULL);
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
        Schema::dropIfExists('webinar');
    }
}
