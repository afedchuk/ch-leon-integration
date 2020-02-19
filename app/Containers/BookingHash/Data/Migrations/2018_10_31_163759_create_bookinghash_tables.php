<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookinghashTables extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('booking_hashes', function (Blueprint $table) {

            $table->increments('id');
            $table->string('reference_number')
                ->unique();
            $table->string('hash');

            $table->timestamps();
            //$table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('booking_hashes');
    }
}
