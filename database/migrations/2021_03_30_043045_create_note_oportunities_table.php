<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteOportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_oportunities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('oportunity_id')->nullable();
            $table->string('title');
            $table->text('description');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('oportunity_id')->references('id')->on('oportunities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_oportunities');
    }
}
