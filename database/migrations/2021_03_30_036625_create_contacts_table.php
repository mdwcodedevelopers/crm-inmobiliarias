<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id');
            $table->string('name');
            $table->string('image');
            $table->string('email',40)->unique();;
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->timestamps();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
