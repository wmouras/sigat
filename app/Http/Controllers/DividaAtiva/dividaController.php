<?php

namespace App\Http\Controllers\DividaAtiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Multa;
use App\Anuidade;
use App\Http\Requests\AnuidadeRequest;
use PDF;
use Barryvdh\Snappy;
class dividaController extends Controller
{
    public function index(){
        $anuidade = new Anuidade;
        $multa = new Multa;
        //===================PEGA AS SOMAS DAS COLUNAS DOS ATIVOS================================
        $totalAnuidade = $anuidade::select('valor_originario')->where('ativo',1)->get();
        $totalRecebidoAnuidade = $totalAnuidade->sum('valor_originario');

        $totalMulta = $multa::select('valor_atualizado')->where('ativo',1)->get();
        $totalRecebidoMulta = $totalMulta->sum('valor_atualizado');

        //===================PEGA AS SOMAS DAS COLUNAS DOS EXTINTOS==============================
        $totalAnuidadeExtintos = $anuidade::select('valor_originario')->where('extinto',1)->get();
        $totalRecebidoAnuidadeExtintos = $totalAnuidadeExtintos->sum('valor_originario');

        $totalMultaExtintos = $multa::select('valor_atualizado')->where('extinto',1)->get();
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
                if(isset($result) && $result->count() == 0){
                    session()->flash('falid', 'Nenhum registro encontrado.');
                    return redirect()->back();
                }
                return view('site.filtro',[
                    'resultado' => $result,
                    'mensagem' =>$mensagem,
                    'opcao' =>$opcao,
                    
                ]);
            
        }elseif($opcao == 'multa'){
                $usuarioMulta = new Multa;
                $result = $usuarioMulta::where('nome','LIKE','%'.$request->busca.'%')->get();
                $mensagem = 'Lista de Multas';
                if(isset($result) && $result->count() == 0){
                    session()->flash('falid', 'Nenhum registro encontrado.');
                    return redirect()->back();
                }
                return view('site.filtro',[
                    'resultado' => $result,
                    'mensagem' =>$mensagem,
                    'opcao' =>$opcao,
                    
                ]);

        }elseif($opcao == 'Selecione'){
            session()->flash('msg', 'Selecione uma opção.');
            return redirect()->back();
        }
      

    }
    public function edit(Request $request){
            /*return view('site.editarRegistro',[
                'user'=>$user
            ]);*/
            if($request->opcao == 'anuidade'){
                $anuidade = new Anuidade;
                $user = $anuidade::where('id',$request->user)->first();
                $situacao = 'Indisponível';
                if($user->ativo == '1'){
                    $situacao = 'Em divida Ativa';
                }
                elseif($user->extinto == '1'){
                    $situacao = 'Extinto';
                }
                return view('site.editarRegistroAnuidade',[
                    'user'=>$user,
                    'situacao' =>$situacao
                ]);
            }elseif($request->opcao == 'multa'){
                $multa = new Multa;
                $user = $multa::where('id',$request->user)->first();
                $situacao = 'Indisponível';
                if($user->ativo == '1'){
                    $situacao = 'Em divida Ativa';
                }
                elseif($user->extinto == '1'){
                    $situacao = 'Extinto';
                }
                return view('site.editarRegistroMulta',[
                    'user'=>$user
                ]);
            }

    }
    public function editar(Request $request){
            if($request->opcao == 'anuidade'){
                $anuidade = new Anuidade;
                $ativo = '1';
                $extinto = '0';
                if($request->select == '1'){
                    $ativo = '1';
                    $extinto = '0';
                }
                elseif($request->select == '0'){
                    $ativo = '0';
                    $extinto = '1';
                }
                $anuidade::where('id',$request->id)->update([
                    'nome'=> $request->nome,
                    'cpf_cnpj' =>$request->cpf_cnpj,
                    'numero'=>$request->numero,
                    'ef'=>$request->ef,
                    'anuidade_inicial'=>$request->anuidade_inicial,
                    'anuidade_final'=>$request->anuidade_final,
                    'valor_originario'=>$request->valor_originario,
                    'ativo' => $ativo,
                    'extinto' => $extinto
                ]);
                session()->flash('sucess', 'Atualizado com sucesso!.');
                return view('site.filtro');
                
            }elseif($request->opcao == 'multa'){
                $multa = new Multa;
                $ativo = '1';
                $extinto = '0';
                if($request->select == '1'){
                    $ativo = '1';
                    $extinto = '0';
                }
                elseif($request->select == '0'){
                    $ativo = '0';
                    $extinto = '1';
                }
                $multa::where('id',$request->id)->update([
                    'nome'=> $request->nome,
                    'cpf_cnpj' =>$request->cpf_cnpj,
                    'numero'=>$request->numero,
                    'ef'=>$request->ef,
                    'valor_originario'=>$request->valor_originario,
                    'ativo' =>$ativo,
                    'extinto' =>$extinto
                ]);
                session()->flash('sucess', 'Atualizado com sucesso!.');
                return view('site.filtro');
            }
           
    }

    public function gerarPdfAno(Request $request){

        if($request->tipo == 'anuidade'){
                $ano = $request->inicial;
                $situacao = $request->situacao;
                $lista = new Anuidade;
                $result = $lista::Raw('SELECT * FROM tbanuidade')->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();

                $somaTotal = $lista::select('valor_originario')->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();
                $total = $somaTotal->sum('valor_originario');
             
                if(isset($result) && $result->count() == 0){
                    session()->flash('msg', 'Nenhum Registro encontrado para o ano: '.$ano. ' na opção selecionada.');
                    return redirect()->back();
                }
                /*return \PDF::loadView('site.pdf',
                 ['lista'=>$result,
                    'situacao' =>$situacao
                 ])->stream('listaAnuidades.pdf');*/
                
                
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem',
                    'situacao' =>$situacao,
                    'total' =>$total
                ]);
           
        }elseif($request->tipo == 'multa'){
                $ano = $request->inicial;
                $situacao = $request->situacao;
                $lista = new Multa;
                $result = $lista::Raw('SELECT * FROM tbmulta')->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();

                $somaTotal = $lista::select('valor_originario')->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();
                $total = $somaTotal->sum('valor_originario');
                if(isset($result) && $result->count() == 0){
                    session()->flash('msg', 'Nenhum Registro encontrado para o ano: '.$ano.' na opção selecionada.');
                    return redirect()->back();
                }

                /*return \PDF::loadView('site.pdf',
                 ['lista'=>$result,
                    'situacao' =>$situacao
                 ])->stream('listaAnuidades.pdf');*/
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem',
                    'situacao' =>$situacao,
                    'total' =>$total
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

                
                $somaTotal = $lista::select('valor_originario')->whereMonth('data_debito',$mes)->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();
                $total = $somaTotal->sum('valor_originario');
                if(isset($result) && $result->count() == 0){
                    session()->flash('msg', 'Nenhum Registro encontrado em '.$mes.'/'.$ano.' para a opção selecionada.');
                    return redirect()->back();
                }

                /*return \PDF::loadView('site.pdf',
                 ['lista'=>$result,
                    'situacao' =>$situacao
                 ])->stream('listaAnuidades.pdf');*/

                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem',
                    'situacao' =>$situacao,
                    'total' =>$total
                ]);
            
        }elseif($request->tipo == 'multa'){
                $situacao = $request->situacao;
                $array1 = explode('/',$request->mes);
                $mes = $array1[0];
                $ano = $array1[1];
                $lista = new Multa;
                $result = $lista::Raw('SELECT * FROM tbmulta')->whereMonth('data_debito',$mes)->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();

                $somaTotal = $lista::select('valor_originario')->whereMonth('data_debito',$mes)->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();
                $total = $somaTotal->sum('valor_originario');
                if(isset($result) && $result->count() == 0){
                    session()->flash('msg', 'Nenhum Registro encontrado em '.$mes.'/'.$ano.' para a opção selecionada.');
                    return redirect()->back();
                }

                /*return \PDF::loadView('site.pdf',
                 ['lista'=>$result,
                    'situacao' =>$situacao
                 ])->stream('listaAnuidades.pdf');*/
                
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem',
                    'situacao' =>$situacao,
                    'total' =>$total
                ]);
            
        }
        
            
    }

    public function gerarPdfTodos(Request $request){
        if($request->tipo == 'anuidade'){
                $situacao = $request->situacao;
                $lista = new Anuidade;
                $result = $lista::Raw('SELECT * FROM tbanuidade')->where('ativo',$situacao)->get();

                $somaTotal = $lista::select('valor_originario')->where('ativo',$situacao)->get();
                $total = $somaTotal->sum('valor_originario');
                if(isset($result) && $result->count() == 0){
                    session()->flash('msg', 'Ainda não possui registro pela opção selecionada.');
                    return redirect()->back();
                }
                /*return \PDF::loadView('site.pdf',
                 ['lista'=>$result,
                    'situacao' =>$situacao
                 ])->stream('listaAnuidades.pdf');*/
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem',
                    'situacao' =>$situacao,
                    'total' =>$total
                ]);
        }elseif($request->tipo == 'multa'){
                $situacao = $request->situacao;
                $lista = new Multa;
                $result = $lista::Raw('SELECT * FROM tbmulta')->where('ativo',$situacao)->get();

                $somaTotal = $lista::select('valor_originario')->where('ativo',$situacao)->get();
                $total = $somaTotal->sum('valor_originario');
                if(isset($result) && $result->count() == 0){
                    session()->flash('msg', 'Ainda não possui registro pela opção selecionada.');
                    return redirect()->back();
                }
                /*return \PDF::loadView('site.pdf',
                 ['lista'=>$result,
                    'situacao' =>$situacao
                 ])->stream('listaAnuidades.pdf');*/
                return view('site.pdf',[
                    'lista' =>$result,
                    'mensagem' =>'$mensagem',
                    'situacao' =>$situacao,
                    'total' =>$total
                ]);
        }
           
    }
}
