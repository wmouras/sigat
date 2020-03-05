<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuidade extends Model
{
    protected $fillable = [
        'nome', 'numero', 'cpf_cnpj','ef','data_debito','valor_originario','anuidade_inicial','anuidade_final'
    ];
    protected $guarded = ['anuidade_id'];
    protected $table = 'tbanuidade';
   

   
    public $timestamps = false;

}
