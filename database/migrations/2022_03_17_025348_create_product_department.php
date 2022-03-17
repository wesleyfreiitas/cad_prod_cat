<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_department', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('department_id');
            //Esse caso é um relacionamento muito para muitos assim foi criado a tabela produto depois departamento e adicioandos esses dois ids acima
            //loco abaixo tenho informo que a jave primaria das duas tabelas fromam a minha chave primaria do relacionamento em questao
            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
            $table->foreign('department_id')->references('id')
                ->on('departments')->onDelete('cascade');
            $table->primary(['product_id','department_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_department');
    }
}
