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
        Schema::table('nomor_terakhirs', function (Blueprint $table) {
            $table->foreignUuid('bidang_id')->nullable()->constrained()->onDelete('CASCADE')->after('opd_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nomor_terakhirs', function (Blueprint $table) {
            //
        });
    }
};
