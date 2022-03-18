<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //aplicado o belongsto, um produto pertence a uma categoria
    public function produtos() {
        return $this->hasMany('App\Produto');
    }
}
