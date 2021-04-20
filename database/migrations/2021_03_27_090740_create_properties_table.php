<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('status_id');
            $table->foreignId('currency_id');
            $table->string('title');
            $table->string('information')->nullable();
            $table->string('province')->nullable();
            $table->string('location')->nullable();
            $table->string('subdivision_1')->nullable();
            $table->string('subdivision_2')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('show_web')->default(0); //0no, 1si
            $table->enum('type', [1, 2]);
            $table->enum('situation', [1, 2]);
            $table->enum('antiquity', [1, 2, 3]);
            $table->enum('condition', [1, 2, 3, 4, 5, 6]);
            $table->enum('keys', [1, 2, 3, 4, 5]);
            $table->decimal('price',20,2);
            $table->decimal('dimension',20,2)->nullable();

            $table->smallInteger('environments')->nullable();
            $table->smallInteger('plants')->nullable();
            $table->smallInteger('bedrooms')->nullable();
            $table->smallInteger('toilettes')->nullable();
            $table->smallInteger('dresser')->nullable();
            $table->smallInteger('chocheras')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
