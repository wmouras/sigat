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
        $totalAnuidade = $anuidade::Raw('SELECT valor_originario FROM tbanuidade')->where('ativo',1)->get();
        $totalMulta = $multa::Raw('SELECT valor_atualizado FROM tb_multa')->where('ativo',1)->get();
        $totalRecebidoAnuidade = $totalAnuidade->sum('valor_originario');
        $totalRecebidoMulta = $totalMulta->sum('valor_atualizado');

        $totalAnuidadeExtintos = $anuidade::Raw('SELECT valor_originario FROM tbanuidade ')->where('ativo',0)->get();
        $totalMultaExtintos = $multa::Raw('SELECT valor_atualizado FROM tb_multa')->where('ativo',0)->get();
        $totalRecebidoAnuidadeExtintos = $totalAnuidadeExtintos->sum('valor_originario');
        $totalRecebidoMultaExtintos = $totalMultaExtintos->sum('valor_atualizado');

       
        return view('site.home',[
            'totalAnuidade'=>$totalRecebidoAnuidade,
            'totalMulta' => $totalRecebidoMulta,
            'totalAnuidadeExinto'=>$totalRecebidoAnuidadeExtintos,
            'totalMultaExinto'=>$totalRecebidoMultaExtintos
        ]);
    }
    public function busca(Request $request){
        $opcao = $request->select;
        $result = '';
        $mensagem ='';
       
        if($opcao == 'anuidade'){
            $mensagem = "Resultados encontrados por: '$request->busca'";
            $usuarioAnuidade = new Anuidade;
            $result = $usuarioAnuidade::where('nome','LIKE','%'.$request->busca.'%')->get();
           
            
        }elseif($opcao == 'multa'){
            $usuarioMulta = new Multa;
            $result = $usuarioMulta::where('nome','LIKE','%'.$request->busca.'%')->get();
            $mensagem = 'Lista de Multas';
        }
       return view('site.busca',[
           'resultado' => $result,
           'mensagem' =>$mensagem,
           
       ]);

    }
    public function edit(Anuidade $user){
            return view('site.editarRegistro',[
                'user'=>$user
            ]);
        

    }
    public function editar(Anuidade $user, Request $request){
            /*$user->nome = $request->nome;
            $user->cpf_cnpj = $request->cpf_cnpj;
            $user->numero = $request->numero;
            $user->ef = $request->ef;
            $user->anuidade_inicial = $request->anuidade_inicial;
            $user->anuidade_final = $request->anuidade_final;
            $user->valor_originario = $request->anuidade_originario;
            $user->save();

            return redirect()->route('home');*/
            dd($user,$request);

    }
}
