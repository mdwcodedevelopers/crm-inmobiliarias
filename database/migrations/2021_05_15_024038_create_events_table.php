<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('user_id');  //Propietario 
            $table->foreignId('event_types_id');  
            $table->foreignId('property_id')->nullable();
            $table->enum('completed', [0, 1, 2])->default(0); //0 En espera, 1 Completado con exito, 2 Fallido
            $table->enum('postponed', [0, 1, 2, 3])->default(0); //0 Sin posponer. #1-3 veces de intento 
            $table->text('report')->nullable();
            $table->timestamps();
            $table->foreign('event_types_id')->references('id')->on('event_types')->onDelete('cascade');
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
