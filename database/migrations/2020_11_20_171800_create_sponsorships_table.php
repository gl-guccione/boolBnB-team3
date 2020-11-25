<?php

// using Laravel Facades
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsorships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flat_id')->constrained();
            $table->foreignId('payment_id')->constrained();
            $table->foreignId('sponsorship_price_id')->constrained();
            $table->dateTime('date_of_start')->nullable();
            $table->dateTime('date_of_end')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsorships');
    }
}
