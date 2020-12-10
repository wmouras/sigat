<?php

namespace App\Http\Controllers\DividaAtiva;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Multa;
use App\Anuidade;
use App\Http\Requests\AnuidadeRequest;
use App\inpc;
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
    public function login(){
        return view('site.login');
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

                // dd( $request );

                $user = $anuidade::where('id',$request->id)->first();

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
                $user = $multa::where('id',$request->id)->first();
                $situacao = 'Indisponível';
                if($user->ativo == '1'){
                    $situacao = 'Em divida Ativa';
                }
                elseif($user->extinto == '1'){
                    $situacao = 'Extinto';
                }
                return view('site.editarRegistroMulta',[
                    'user'=>$user,
                    'situacao' =>$situacao
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
                    'valor_originario'=>alteraValorBd($request->valor_originario),
                    'ativo' => $ativo,
                    'extinto' => $extinto,
                    'valor_atualizado' => alteraValorBd($request->valor_recebido)
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
                    'valor_originario'=>alteraValorBd($request->valor_originario),
                    'ativo' =>$ativo,
                    'extinto' =>$extinto,
                    'valor_atualizado' => alteraValorBd($request->valor_recebido)
                ]);
                session()->flash('sucess', 'Atualizado com sucesso!.');
                return view('site.filtro');
            }

    }

    public function delete(Request $request){
        if($request->opcao == 'anuidade'){
            $anuidade = new Anuidade;

            $anuidade::where('id',$request->user)->delete();

            session()->flash('sucess', 'Processo excluído com sucesso!.');
            return view('site.filtro');

        }elseif($request->opcao == 'multa'){
            $multa = new Multa;

            $multa::where('id',$request->user)->delete();
            session()->flash('sucess', 'Processo excluído com sucesso!.');
            return view('site.filtro');
        }
    }

    public function gerarPdfAno(Request $request){

        if($request->tipo == 'anuidade'){
                $ano = $request->inicial;
                $situacao = $request->situacao;
                $lista = new Anuidade;
                $result = $lista::Raw('SELECT * FROM tbanuidade')->whereYear('data_debito',$ano)->where('ativo',$situacao)  ->get();
                $arrayResult = array();
                //calculos
                foreach ($result as $key => $value) {
                    $vetor =  $value['cpf_cnpj'];
                    $nome = $value['nome'];
                    $numero = $value['numero'];
                    $ef = $value['ef'];
                    $dataDebito = $value['data_debito'];
                    $anuidade_inicial = $value['anuidade_inicial'];
                    $anuidade_final = $value['anuidade_final'];
                    $valorOriginal = $value['valor_originario'];
                    $totalMultas = "";
                    $totalJuros = "";
                    $valorAtu = '';
                    $cpf_cnpj = preg_replace("/[^0-9]/", "", $vetor);
                    $qntNumeros = strlen($cpf_cnpj);
                    if($qntNumeros == '11'){
                        $faix = \DB::connection('mysql2')->table('profiss')->select(\DB::raw('max(RIGHT(SUB_TIT,1)) as result'))->where('CPF',$cpf_cnpj)->get();
                        $mesPadrão = '2'; // valor pradrão;
                        $porcentagem = '20';
                        $f = $faix[0];
                        $faixa = $f->result;
                        $novaFaixa = '';
                        if($faixa   == '1'|| $faixa =='2'|| $faixa == '4'){
                            $novaFaixa = "S";
                        }elseif($faixa == '3'){
                            $novaFaixa = "M" ;
                        }elseif($faixa == 'null'){

                        }
                        $anoAtual = date('Y');
                        $mesAtual = date('m');
                        $inpc = \DB::connection('mysql3')->table('inpc')->select('no_mes')->whereNotIn('mes',[1,2,3])->where('ano',$anoAtual)->get();
                        $somaInpc = $inpc->SUM('no_mes');
                        $valorDAnuidade = \DB::connection('mysql3')->table('contas_val_padroes')->select('valor')->where('faixa',$novaFaixa)->where('mes', $mesPadrão)->where('ano',$anoAtual)->first();

                        $valorDaAnuidade = '';
                        $total = '';
                        if($valorDAnuidade == null){
                            $valorDaAnuidade = '0';
                            $total = '0';

                        }else{

                            $valorDaAnuidade = $valorDAnuidade->valor;
                            $totalDeAnuidades = calculaTotalAnuidades($valorDaAnuidade, $anuidade_inicial, $anuidade_final);
                            $totalDeMultas = calculaTotalMultas($valorDaAnuidade, $porcentagem, $anuidade_inicial, $anuidade_final);
                            $totalMultas = number_format($totalDeMultas, 2, ',','.');

                            $totalDeJuros = calculatotalJuros($valorDaAnuidade, $anuidade_inicial, $anuidade_final, $anoAtual, $mesAtual);
                            $totalJuros =  number_format($totalDeJuros, 2, ',','.');

                            $totalDeMesesAtrasso = calculoDosMeses($anuidade_inicial, $anuidade_final, $anoAtual, $mesAtual);
                            $total = $totalDeAnuidades + $totalDeMultas + $totalDeJuros;

                            $valorAtu =  number_format($total, 2, ',','.');

                        }
                    }
                    elseif($qntNumeros == '14'){
                        $anoAtual = date('Y');
                        $mesAtual = date('m');
                        $cap = \DB::connection('mysql2')->table('firmas')->select('CAPITAL')->where('CGC',$cpf_cnpj)->get();
                        $capEmp = $cap[0];
                        $capitalDaEmpresa = $capEmp->CAPITAL;
                        $faixaDaEmpresa = verificaFaixa($capitalDaEmpresa);
                        $mesPadrão = '2'; // valor pradrão;
                        $porcentagem = '20';
                        $valorDAnuidade = \DB::connection('mysql3')->table('contas_val_padroes')->select('valor')->where('faixa',$faixaDaEmpresa)->where('mes', $mesPadrão)->where('ano',$anoAtual)->first();
                        $valorDaAnuidade = '';
                        $total = '';
                        if($valorDAnuidade == null){
                            $valorDaAnuidade = '0';
                            $total = '0';
                        }else{

                            $valorDaAnuidade = floatval($valorDAnuidade->valor);
                            $totalDeAnuidades = calculaTotalAnuidades($valorDaAnuidade, $anuidade_inicial, $anuidade_final);
                            $totalDeMultas = calculaTotalMultas($valorDaAnuidade, $porcentagem, $anuidade_inicial, $anuidade_final);
                            $totalMultas = number_format($totalDeMultas, 2, ',','.');

                            $totalDeJuros = calculatotalJuros($valorDaAnuidade, $anuidade_inicial, $anuidade_final, $anoAtual, $mesAtual);
                            $totalJuros =  number_format($totalDeJuros, 2, ',','.');

                            $totalDeMesesAtrasso = calculoDosMeses($anuidade_inicial, $anuidade_final, $anoAtual, $mesAtual);
                            $total = $totalDeAnuidades + $totalDeMultas + $totalDeJuros;
                            $valorAtu =  number_format($total, 2, ',','.');
                        }
                    }
                    //echo $nome."cpf". '='.$cpf_cnpj. "Multas". '='.$totalDeMultas."Juros==".$totalDeJuros."Valor Atualizajdo = ".$valorAtualizado.'<br>';
                   // $arrayResult[$nome][$numero][$ef][ $dataDebito][$anuidade_inicial][$anuidade_final][$totalDeMultas][ $totalDeJuros][$valorOriginal][$valorAtualizado] = array();

                   $arrayResult[] = array(
                                            "nome" => $nome,
                                            "ef"=> $ef,
                                            "dataDebito" =>$dataDebito,
                                            "anuidadeInicial"=>$anuidade_inicial,
                                            "anuidadeFinal" => $anuidade_final,
                                            "totalMultas" => $totalMultas,
                                            "totalJuros" => $totalJuros,
                                            "valorOriginal" => $valorOriginal,
                                            "valorAtualizado" => $valorAtu
                                        );
                }

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
                    'lista' =>$arrayResult,
                    'mensagem' =>'$mensagem',
                    'situacao' =>$situacao,
                    'total' =>$total,
                    'tipo' => 'anuidade',
                ]);

        }elseif($request->tipo == 'multa'){
                $ano = $request->inicial;
                $situacao = $request->situacao;
                $lista = new Multa;
                $result = $lista::Raw('SELECT * FROM tbmulta')->whereYear('data_debito',$ano)->where('ativo',$situacao)->get();
                $arrayResult = array();
                 //calculos
                 /*foreach ($result as $key => $value) {
                    $vetor =  $value['cpf_cnpj'];
                    $nome = $value['nome'];
                    $numero = $value['numero'];
                    $ef = $value['ef'];
                    $dataDebito = $value['data_debito'];
                    $valorOriginal = $value['valor_originario'];

                    $cpf_cnpj = preg_replace("/[^0-9]/", "", $vetor);
                    $qntNumeros = strlen($cpf_cnpj);

                    $dat = str_replace('/','-',$dataDebito);
                    $data = date('Y-m-d', strtotime($dat));
                    $ano = date('Y',strtotime($data));
                    $mes = date('m',strtotime($data));
                    $mesAnterior = $mes - 1;
                    /// Datas atuais
                    $anoAtual = date('Y');
                    $mesAt = date('m');
                    $mesAtual = $mesAt - 1;

                    $indAtual = \DB::connection('mysql3')->table('inpc')->select('numero_indice')->where('mes',$mesAtual)->where('ano', $anoAtual)->get();
                    $indAt = $indAtual[0];
                    $indiceAtual = $indAt->numero_indice;

                    $indAnt = \DB::connection('mysql3')->table('inpc')->select('numero_indice')->where('mes',$mesAnterior)->where('ano', $ano)->get();
                    $indAnte = $indAnt[0];
                    $indiceAnterior = $indAnte->numero_indice;

                    //Meses em atrasso
                    $a1 = ($anoAtual - $ano) * 12;
                    $m1 = ($mesAtual - $mesAnterior) * -1;
                    $mesesAtraso = ($m1 + $a1);

                    $total = total($indiceAtual, $indiceAnterior, $request->valorOriginario, $mesesAtraso);
                    $jurosMulta = juros($indiceAtual, $indiceAnterior, $request->valorOriginario, $mesesAtraso);
                    $correcaoMonetaria = correcaoMonetaria($indiceAtual, $indiceAnterior, $request->valorOriginario);

                    //echo $nome."cpf". '='.$cpf_cnpj. "Multas". '='.$totalDeMultas."Juros==".$totalDeJuros."Valor Atualizajdo = ".$valorAtualizado.'<br>';
                   // $arrayResult[$nome][$numero][$ef][ $dataDebito][$anuidade_inicial][$anuidade_final][$totalDeMultas][ $totalDeJuros][$valorOriginal][$valorAtualizado] = array();

                   $arrayResult[] = array(
                                            "nome" => $nome,
                                            "ef"=> $ef,
                                            "dataDebito" =>$dataDebito,
                                            "anuidadeInicial"=>$anuidade_inicial,
                                            "anuidadeFinal" => $anuidade_final,
                                            "totalMultas" => $totalMultas,
                                            "totalJuros" => $totalJuros,
                                            "valorOriginal" => $valorOriginal,
                                            "valorAtualizado" => $valorAtu
                                        );
                }*/

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
                $result = Anuidade::select(['id', 'nome', 'numero', 'cpf_cnpj', 'ef', 'data_debito as dataDebito', 'valor_originario as valorOriginal', 'valor_anuidade as totalMultas', 'valor_anuidade_atualizado as totalJuros', 'valor_atualizado as valorAtualizado', 'ativo', 'anuidade_inicial as anuidadeInicial', 'anuidade_final as anuidadeFinal', 'extinto'])->where('ativo',$situacao)->get();

                // dd( $result[0] );

                $somaTotal = Anuidade::select('valor_originario')->where('ativo',$situacao)->get();
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
                    'total' =>$total,
                    'tipo' => 'anuidade',
                ]);
        }elseif($request->tipo == 'multa'){
                $situacao = $request->situacao;
                $lista = new Multa;
                $result = Multa::select(['id', 'nome', 'ef', 'cpf_cnpj', 'data_debito as dataDebito', 'valor_originario as valorOriginal', 'valor_atualizado as valorAtualizado', 'juros as TotalJuros', 'ativo', 'extinto'])->where('ativo',$situacao)->get();

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
                    'total' =>$total,
                    'tipo' => 'multa'
                ]);
        }

    }
}
