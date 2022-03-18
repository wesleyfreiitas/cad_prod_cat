<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /*Estou dentro de endereço e quero referenciar a tabela de cliente
     então busca o nome do campo underline id da tabela endereco que corresponde
     a um campo na tabela cliente.*/
     public function cliente(){
        return $this->belongsTo('App\Cliente', 'cliente_id', 'id');
    }
}
