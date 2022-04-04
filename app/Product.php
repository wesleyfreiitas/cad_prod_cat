<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //aplicado o belongsto, um produto pertence a uma categoria
    public function product() {
        return $this->hasMany('App\Product');
    }
    //Aqui estou na minha tabela filha , que é dependente da tabela department
    public function department() {
        return $this->belongsTo('App\Department');
    }
}
