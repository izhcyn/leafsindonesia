<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('recipient_name');  // Nama penerima
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->string('product_name');    // Nama produk
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();

        });

    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
