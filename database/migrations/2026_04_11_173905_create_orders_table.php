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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status')->default('pending'); // pending, confirmed, shipped, delivered, cancelled
            $table->decimal('subtotal', 10, 2);
            $table->decimal('delivery_price', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            
            // Delivery info
            $table->string('delivery_method'); // standard, express, pickup
            $table->string('delivery_title');
            
            // Payment info
            $table->string('payment_method'); // card, bank, cash
            $table->string('payment_title');
            
            // Customer details
            $table->string('customer_email');
            $table->string('customer_phone')->nullable();
            $table->string('customer_first_name');
            $table->string('customer_last_name');
            $table->text('customer_address');
            $table->string('customer_city');
            $table->string('customer_zip');
            $table->string('customer_country');
            
            // Additional flags
            $table->boolean('billing_same')->default(true);
            $table->boolean('newsletter')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
