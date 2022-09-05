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
        Schema::create('tb_bairro', function (Blueprint $table) {
            $table->id('codigo_bairro');
            $table->unsignedBigInteger('codigo_municipio');
            $table->string('nome');
            $table->integer('status');
            $table
                ->foreign('codigo_municipio')
                ->references('codigo_municipio')
                ->on('tb_municipio')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_bairro');
    }
};
