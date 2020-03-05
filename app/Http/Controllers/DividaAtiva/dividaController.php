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

    public function gerarPdfAno(Request $request){

        if($request->tipo == 'anuidade'){
                $ano = $request->inicial;
                $situacao = $request->situacao;
                $lista = new Anuidade;
                $result = $lista::Raw('SELECT * FROM tbanuidade')->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem'
                ]);
           
        }elseif($request->tipo == 'multa'){
                $ano = $request->inicial;
                $situacao = $request->situacao;
                $lista = new Multa;
                $result = $lista::Raw('SELECT * FROM tb_multa')->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem'
                ]);
        }
           
    }

    public function gerarPdfMes(Request $request){
        if($request->tipo == 'anuidade'){
                $situacao = $request->situacao;
                $array1 = explode('/',$request->mes);
                $mes = $array1[0];
                $ano = $array1[1];
                $lista = new Anuidade;
                $result = $lista::Raw('SELECT * FROM tbanuidade')->whereMonth('data_debito',$mes)->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem'
                ]);
            
        }elseif($request->tipo == 'multa'){
                $situacao = $request->situacao;
                $array1 = explode('/',$request->mes);
                $mes = $array1[0];
                $ano = $array1[1];
                $lista = new Multa;
                $result = $lista::Raw('SELECT * FROM tb_multa')->whereMonth('data_debito',$mes)->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem'
                ]);
           
        }
            
    }

    public function gerarPdfTodos(Request $request){
        if($request->tipo == 'anuidade'){
                $situacao = $request->situacao;
                $lista = new Anuidade;
                $result = $lista::Raw('SELECT * FROM tbanuidade')->where('ativo',$situacao)->get();
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem'
                ]);
        }elseif($request->tipo == 'multa'){
                $situacao = $request->situacao;
                $lista = new Multa;
                $result = $lista::Raw('SELECT * FROM tb_multa')->where('ativo',$situacao)->get();
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem'
                ]);
        }
            
            
    }
}
