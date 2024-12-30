<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->binary('image')->nullable(); // Ganti longBlob() dengan binary()
            $table->string('genus', 100)->nullable();
            $table->string('ukuran', 50)->nullable();
            $table->string('deskripsi', 100)->nullable();
            $table->string('nama', 100);
            $table->decimal('harga', 10, 2);
            $table->enum('label', ['hot_item', 'last_stock', 'only_one'])->nullable();
            $table->integer('stock');
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
        Schema::dropIfExists('produk');
    }
}
