<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    //
    function project(){
        //relacionamentos muito pra muitos
        //sobre o retorno da função, informo que eu quero saber apartir da tabela developer quais projetos
        //está alocado pra cada dev. A primeira instrução é o modelo developer e o segundo é a tabela relacionada
        return $this->belongsToMany("App\Project", "alocations")->withPivot('horas_semanais');
        //withpivot vai retornar o campo de relacionamento da tabela do meio do muitos para muitos
    }
}
