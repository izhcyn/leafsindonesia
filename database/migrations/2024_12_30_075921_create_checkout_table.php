<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutTable extends Migration
{
    public function up()
    {
        Schema::create('checkout', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_name');
            $table->text('recipient_address');
            $table->string('recipient_phone');
            $table->string('product_name');
            $table->integer('quantity');
            $table->string('country');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checkout');
    }
}
