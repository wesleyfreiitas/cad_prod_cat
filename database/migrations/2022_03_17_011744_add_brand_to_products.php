<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBrandToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produtos', function (Blueprint $table) {
            //Nesse cenário eu faço altero uma tabela que já exite sem ter que mexer nela inteira
            //Mas caso o contrario eu teria que criar a tabela categoria antes da tabela de produto e inserir o dado que eu quero nela
            //Abaixo um exemplo de como inserir o dado em produtos cirando a tabela categoria antes
            //$table->integer('categoria_id')->unsigned();
            //$table->foreign('categoria_id')->references('id')->on('categorias');
            $table->unsignetBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
