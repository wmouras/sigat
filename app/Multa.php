<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Multa extends Model
{
    protected $fillable = [
        'nome', 'numero', 'cpf_cnpj','ef','data_debito','valor_originario',
    ];
    protected $guarded = ['multa_id'];
    protected $table = 'tb_multa';
    	
    public $timestamps = false;
}
