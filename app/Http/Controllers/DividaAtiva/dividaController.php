<?php

namespace App\Http\Controllers\DividaAtiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Multa;
use App\Anuidade;
class dividaController extends Controller
{
    public function index(){
        $anuidade = new Anuidade;
        $multa = new Multa;
        $totalAnuidade = $anuidade::Raw('SELECT valor_originario FROM tb_anuidade WHERE ativo = 1')->get();
        $totalMulta = $multa::Raw('SELECT valor_atualizado FROM tb_multa WHERE ativo=1')->get();
        $totalRecebidoAnuidade = $totalAnuidade->sum('valor_originario');
        $totalRecebidoMulta = $totalMulta->sum('valor_atualizado');
        return view('site.home',[
            'totalAnuidade'=>$totalRecebidoAnuidade,
            'totalMulta' => $totalRecebidoMulta,
        ]);
    }
    public function busca(Request $request){
        $opcao = $request->select;
        $result = '';
        if($opcao == 'anuidade'){
            $usuarioAnuidade = new Anuidade;
            $result = $usuarioAnuidade::where('nome','LIKE','%'.$request->busca.'%')->get();
        }elseif($opcao == 'multa'){
            $usuarioMulta = new Multa;
            $result = $usuarioMulta::where('nome','LIKE','%'.$request->busca.'%')->get();
        }
       return view('site.filtro',[
           '$resultado' =>$result
       ]);

    }
}
