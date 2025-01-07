<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('user_id'); // Foreign Key to users table
            $table->unsignedInteger('produk_id'); // Foreign Key to produk table
            $table->unsignedInteger('quantity'); // Quantity
            $table->enum('status', ['pending', 'checked_out', 'canceled'])->default('pending'); // Status
            $table->decimal('price', 10, 2)->default('0');
            $table->timestamps(); // Created_at and Updated_at
            // Indexes
            $table->index('produk_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart');
    }
}
