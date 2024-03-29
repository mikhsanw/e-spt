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
        Schema::create('spt_pegawais', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_sppd')->nullable();
            $table->char('status_dibaca',2)->nullable();
            $table->foreignUuid('spt_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignUuid('pegawai_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignUuid('bidang_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignUuid('jabatan_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spt_pegawais');
    }
};
