<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('oportunities', function (Blueprint $table) {
            $table->foreignId('id');
            $table->foreignId('user_id');
            $table->foreignId('contact_id');
            $table->foreignId('status_id');
            $table->string('name');
            $table->date('vigency');
            $table->boolean('closed')->default(0); //0abierto, 1cerrado
            $table->string('closed_reason')->nullable();
            $table->text('closed_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oportunities');

    }
}
