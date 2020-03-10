<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    protected $fillable = [
        'nome', 'numero', 'cpf_cnpj','ef','data_debito','valor_originario','valor_atualizado','ativo','extinto', 'ativo', 'extinto'
    ];
    protected $guarded = ['id'];
    protected $table = 'tbmulta';
    	
    public $timestamps = false;
}
