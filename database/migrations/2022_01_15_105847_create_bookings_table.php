<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->boolean("present")->default(0);
            $table->foreignId("user_id")->constrained();
            $table->foreignId("course_id")->constrained();
            $table->foreignId("timing_id")->constrained();
            $table->dateTime("session_date");
            $table->string("booking_group_id");
            $table->integer("session_num");
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
        Schema::dropIfExists('bookings');
    }
}
