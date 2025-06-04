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
     $table->string('booking_number')->unique();
    $table->string('name');
    $table->string('title');
    $table->string('address')->nullable();
    $table->string('post_code')->nullable();
    $table->string('contact_number');
    $table->string('email');
    $table->unsignedBigInteger('services'); 
    $table->integer('no_of_guest');
    $table->unsignedBigInteger('promotions')->nullable(); 
    $table->unsignedBigInteger('sales_agents');
    $table->unsignedBigInteger('booking_agent');
    $table->decimal('deposit_amount', 10, 2); 
    $table->decimal('pay_on_day', 10, 2)->nullable();
    $table->string('status')->default('pending'); 
    $table->unsignedBigInteger('payment_method')->nullable();

    $table->date('booking_date'); // Changed from start/end dates
    $table->time('start_time');   // New field for start time
    $table->time('end_time');     
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
