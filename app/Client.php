<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //Criando um relacionamento do tipo HasOne
    public function endereco(){
        //Assim eu digo ao laravel que ele deve buscar um endereco na tabela endereco
        return $this->hasOne('App\Endereco', 'cliente_id', 'id');
        /*Após adicionar o modelo, vou identificar o id na tabela endereco e em
        seguida o id da tabela cliente.*/
    }
}
