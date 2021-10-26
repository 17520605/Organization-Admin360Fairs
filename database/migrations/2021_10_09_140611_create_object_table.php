<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object', function (Blueprint $table) {
            $table->id();
            $table->integer('tourId');
            $table->integer('ownerId')->nullable();
            $table->string('type');
            $table->string('source');
            $table->string('name');
            $table->string('description');
            $table->string('content')->nullable();
            $table->string('url');
            $table->string('format');
            $table->integer('width');
            $table->integer('height');
            $table->integer('size');
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
        Schema::dropIfExists('object');
    }
}
