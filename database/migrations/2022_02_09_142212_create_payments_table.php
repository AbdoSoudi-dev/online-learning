<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string("email_address");
            $table->string("name");
            $table->string("country_code");
            $table->string("payment_id");
            $table->string("payer_id");
            $table->string("booking_group_id");

            $table->string("amount");


            $table->foreignId("user_id")->constrained();
            $table->foreignId("booking_id")->constrained();

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
        Schema::dropIfExists('payments');
    }
}
