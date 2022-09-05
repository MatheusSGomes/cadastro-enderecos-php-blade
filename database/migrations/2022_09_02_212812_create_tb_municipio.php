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
        Schema::create('tb_municipio', function (Blueprint $table) {
            $table->id('codigo_municipio');
            $table->unsignedBigInteger('codigo_uf');
            $table->string('nome');
            $table->integer('status');
            $table
                ->foreign('codigo_uf')
                ->references('codigo_uf')
                ->on('tb_uf')
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
        Schema::dropIfExists('tb_municipio');
    }
};
