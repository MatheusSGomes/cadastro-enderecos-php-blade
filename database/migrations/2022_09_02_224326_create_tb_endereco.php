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
        Schema::create('tb_endereco', function (Blueprint $table) {
            $table->id('codigo_endereco');
            $table->unsignedBigInteger('codigo_pessoa');
            $table->unsignedBigInteger('codigo_bairro');
            $table->string('nome_rua');
            $table->string('numero', 10);
            $table->string('complemento', 20);
            $table->string('cep', 10);
            $table
                ->foreign('codigo_pessoa')
                ->references('codigo_pessoa')
                ->on('tb_pessoa')
                ->onDelete('cascade');
            $table
                ->foreign('codigo_bairro')
                ->references('codigo_bairro')
                ->on('tb_bairro')
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
        Schema::dropIfExists('tb_endereco');
    }
};
