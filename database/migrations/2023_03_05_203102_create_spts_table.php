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
        Schema::create('spts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('no_spt')->nullable();
            $table->string('maksud_perjalanan')->nullable();
            $table->string('tempat_berangkat')->nullable();
            $table->string('tempat_tujuan')->nullable();
            $table->json('angkutan')->nullable();
            $table->date('tanggal_berangkat')->nullable();
            $table->date('tanggal_kembali')->nullable();
            $table->date('tanggal_penetapan')->nullable();
            $table->char('status_spt',2)->nullable();
            $table->json('perihal_notadinas')->nullable();
            $table->foreignUuid('bidang_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignUuid('pegawai_id')->nullable()->constrained()->onDelete('CASCADE');
            $table->foreignUuid('kegiatan_id')->nullable()->constrained()->onDelete('CASCADE');
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
        Schema::dropIfExists('spts');
    }
};
