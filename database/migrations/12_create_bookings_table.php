<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->uuid('hotel_id')->nullable();
            $table->uuid('room_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->nullable();
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->nullable();
            $table->string('booking_code')->unique();
            $table->string('guest_name');
            $table->string('guest_email');
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->string('qr_code');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('guest_count');
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
