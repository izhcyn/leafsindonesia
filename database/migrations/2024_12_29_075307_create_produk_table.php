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
<<<<<<< HEAD
            $table->string('deskripsi', 255)->nullable();
=======
            $table->string('deskripsi')->nullable();
>>>>>>> 203ad868876a444f1ec0d99681f1f49f71d96d5f
            $table->string('nama', 100);
            $table->decimal('price', 10, 2);
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
