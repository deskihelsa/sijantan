<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRambuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rambu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_rambu')->length(7);
            $table->string('nama_rambu')->length(70);
            $table->bigInteger('jenis_rambu_id');
            $table->text('keterangan');
            $table->string('gambar');
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
        Schema::dropIfExists('rambu');
    }
}
