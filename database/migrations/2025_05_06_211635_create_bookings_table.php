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
        // Schema::create('bookings', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('contact_number');
        //     $table->string('email');
        //     $table->string('services'); 
        //     $table->integer('no_of_guest');
        //     $table->string('promotions')->nullable(); 
        //     $table->string('sales_agents');
        //     $table->string('booking_agent');
        //     $table->decimal('deposit_amount', 10, 2); 
        //     $table->decimal('sales_amount', 10, 2);
        //     $table->string('status')->default('pending'); 
        //     $table->date('start');

        //     $table->date('end');
        //     $table->timestamps();
        // });

        Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('contact_number');
    $table->string('email');
    $table->string('services'); 
    $table->integer('no_of_guest');
    $table->string('promotions')->nullable(); 
    $table->string('sales_agents');
    $table->string('booking_agent');
    $table->decimal('deposit_amount', 10, 2); 
    $table->decimal('sales_amount', 10, 2);
    $table->string('status')->default('pending'); 
    $table->date('booking_date'); // Changed from start/end dates
    $table->time('start_time');   // New field for start time
    $table->time('end_time');     // New field for end time
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
