<?php

namespace App\Http\Controllers\DividaAtiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Multa;
use App\Anuidade;
use App\Http\Requests\AnuidadeRequest;
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
     
       
        if($opcao == 'anuidade'){
            $mensagem = "Resultados encontrados por: '$request->busca'";
            $usuarioAnuidade = new Anuidade;
            $result = $usuarioAnuidade::where('nome','LIKE','%'.$request->busca.'%')->get();
            return view('site.filtro',[
                'resultado' => $result,
                'mensagem' =>$mensagem,
                
            ]);
            
        }elseif($opcao == 'multa'){
            $usuarioMulta = new Multa;
            $result = $usuarioMulta::where('nome','LIKE','%'.$request->busca.'%')->get();
            $mensagem = 'Lista de Multas';
            return view('site.filtro',[
                'resultado' => $result,
                'mensagem' =>$mensagem,
                
            ]);
        }elseif($opcao == 'Selecione'){
            session()->flash('msg', 'Escolha uma opção.');
            return redirect()->back();
        }
      

    }
    public function edit(Anuidade $user){
            return view('site.editarRegistro',[
                'user'=>$user
            ]);

    }
    public function editar(Anuidade $user, Request $request){
            
            $user->update($request->all());
            session()->flash('msg', 'Atualizado com sucesso!.');
            return redirect()->back();

    }
}
