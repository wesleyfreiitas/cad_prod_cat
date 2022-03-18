<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            /*se tiver um cliente na tabela de cliente vou ter um endereço na tabela endereço
            Não tem o mesmo endereço pra mais de um cliente e não tem endereço pra um cliente
            que não exite na tabela de clientes.*/
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            //Abaixo o cliente id foi transformado em chave primária.
            $table->primary('client_id');
            $table->string('rua');
            $table->integer('numero');
            $table->string('bairro');
            $table->string('uf');
            $table->string('cep');
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
        Schema::dropIfExists('addresses');
    }
}
