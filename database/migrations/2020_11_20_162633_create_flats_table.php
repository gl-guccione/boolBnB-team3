<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->boolean('active')->default(true);
            $table->tinyInteger('number_of_rooms');
            $table->tinyInteger('number_of_beds');
            $table->tinyInteger('number_of_bathrooms');
            $table->smallInteger('mq');
            $table->float('price', 6, 2);
            $table->string('type', 30);
            $table->text('description');
            $table->tinyInteger('stars');
            $table->string('extra_options')->nullable();
            $table->string('street_name');
            $table->string('zip_code', 5);
            $table->string('city');
            $table->string('lat', 10);
            $table->string('lng', 11);
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
        Schema::dropIfExists('flats');
    }
}
