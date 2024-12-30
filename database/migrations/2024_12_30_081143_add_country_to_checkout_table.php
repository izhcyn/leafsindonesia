<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkout', function (Blueprint $table) {
            $table->string('country')->nullable()->after('whatsapp_number'); // Ganti 'column_name' dengan kolom terakhir pada tabel.
        });
    }

    public function down()
    {
        Schema::table('checkout', function (Blueprint $table) {
            $table->dropColumn('country');
        });
    }

};
