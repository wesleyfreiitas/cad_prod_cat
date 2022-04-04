<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //no relacionamento um para muitos o hasmany é usado no lado um. então para uma categoria eu tenho vários produtos
    public function product() {
        return $this->hasMany('App\Product');
    }

    
}
