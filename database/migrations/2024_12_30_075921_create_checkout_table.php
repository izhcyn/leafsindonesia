<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('recipient_name'); // Nama penerima
            $table->text('recipient_address'); // Alamat penerima (termasuk negara)
            $table->string('recipient_phone'); // Nomor telepon penerima
            $table->string('product'); // Produk yang di-checkout
            $table->string('whatsapp_number'); // Nomor WhatsApp
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkouts');
    }
}
