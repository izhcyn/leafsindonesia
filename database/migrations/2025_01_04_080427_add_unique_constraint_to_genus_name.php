<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUniqueConstraintToGenusName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('genus', function (Blueprint $table) {
            // Tambahkan constraint unik jika belum ada
            if (!Schema::hasColumn('genus', 'name')) {
                $table->string('name')->unique()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('genus', function (Blueprint $table) {
            $table->dropUnique(['name']); // Hapus constraint unik
        });
    }
}
