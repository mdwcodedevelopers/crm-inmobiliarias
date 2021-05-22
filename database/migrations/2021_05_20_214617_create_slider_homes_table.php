<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSliderHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_homes', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->string('subtitle');
            $table->string('url')->default('#');
            $table->string('button')->default('Ver más');
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
        Schema::dropIfExists('slider_homes');
    }
}
