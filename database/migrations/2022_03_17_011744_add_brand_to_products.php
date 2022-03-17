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
        Schema::table('products', function (Blueprint $table) {
            //Nesse cenário eu faço altero uma tabela que já exite sem ter que mexer nela inteira
            //Mas caso o contrario eu teria que criar a tabela brand antes da tabela de produto e inserir o dado que eu quero nela
            //Abaixo um exemplo de como inserir o dado em produtos cirando a tabela brand antes
            //$table->integer('brand_id')->unsigned();
            //$table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
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
            $table->dropForeign(['brand_id']);
            $table->dropColumn(['brand_id']);
        });
    }
}
