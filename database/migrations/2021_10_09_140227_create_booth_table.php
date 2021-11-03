<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoothTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booth', function (Blueprint $table) {
            $table->id();
            $table->integer('tourId');
            $table->integer('ownerId')->nullable();
            $table->integer('sceneId')->nullable();
            $table->integer('storageLimit')->nullable();
            $table->string('storageLimit')->nullable();
            $table->string('logo')->nullable();
            $table->dateTime('lastChangeAt');
            $table->string('status')->default('No owner');
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
        Schema::dropIfExists('booth');
    }
}
