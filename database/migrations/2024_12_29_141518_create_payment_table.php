<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key to users table
            $table->unsignedBigInteger('cart_id'); // Foreign Key to carts table
            $table->decimal('amount', 10, 2); // Total amount of the transaction
            $table->string('payment_method'); // Payment method (e.g., credit card, PayPal)
            $table->string('payment_status')->default('pending'); // Payment status (e.g., pending, completed)
            $table->string('transaction_id')->nullable(); // Transaction ID from payment gateway
            $table->timestamps(); // created_at and updated_at

            // Indexes
            $table->index('user_id');
            $table->index('cart_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
