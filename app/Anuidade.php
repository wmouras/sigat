<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuidade extends Model
{
    protected $fillable = [
        'nome', 'numero', 'cpf_cnpj','ef','data_debito','valor_originario','anuidade_inicial','anuidade_final','ativo','extinto','valor_anuidade','valor_anuidade_atualizado'
    ];
    protected $guarded = ['id'];
    protected $table = 'tbanuidade';
   
    public $timestamps = false;

}
