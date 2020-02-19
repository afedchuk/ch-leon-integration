<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingfollowTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('booking_follows', function (Blueprint $table) {

            $table->increments('id');
            $table->string('reference_number')
                ->unique();
            $table->dateTime('follow_until');

            $table->timestamps();
            //$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('booking_follows');
    }
}
