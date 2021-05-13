<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('min_agents');
            $table->integer('min_clients');
            $table->text('description');
            $table->string('color');
            $table->boolean('notify_after')->default(0); //despues
            $table->boolean('notify_after_agent')->default(0); //despues copia para agente
            $table->boolean('notify_before')->default(0); //antes
            $table->boolean('notify_before_agent')->default(0); //antes copia para agente
            $table->text('message_after');
            $table->text('message_before');
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
        Schema::dropIfExists('event_types');
    }
}
