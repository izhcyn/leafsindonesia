<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceToCartTable extends Migration
{
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->default(0)->after('produk_id');
        });
    }

    public function down()
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
