<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('contact_number');
            $table->string('email');
            $table->string('services'); // or text() if it can be long
            $table->integer('no_of_guest');
            $table->string('promotions')->nullable(); // assuming it's optional
            $table->string('sales_agents');
            $table->string('booking_agent');
            $table->decimal('deposit_amount', 10, 2); // 10 digits total, 2 after decimal
            $table->decimal('sales_amount', 10, 2);
            $table->string('status')->default('pending'); // you can set a default status
            $table->date('start');

            $table->date('end');
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
};
