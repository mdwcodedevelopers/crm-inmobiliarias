<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proservices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id');
            $table->foreignId('service_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proservices');
    }
}
