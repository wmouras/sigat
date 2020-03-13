<?php

namespace App\Http\Controllers\Anuidades;

use App\Anuidade;
use App\inpc;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;


use App\Http\Requests\AnuidadeRequest;

class anuidadeController extends Controller
{
    
    public function index()
    {
        
    }

   
    public function create()
    {
        return view('cadastrarAnuidade');
    }

   
    public function store(AnuidadeRequest $request)
    {
        $user = new Anuidade;
        $dat = str_replace('/','-',$request->data_debito);
        $data = date('Y-m-d', strtotime($dat));
        $cpf_cnpj = $request->cpf_cnpj; // pega ultimo cpf/cnpj
        $anuidade_inicial = $request->anuidadeInicial;
        $anuidade_final = $request->anuidadeFinal;
        $qtdNumeros = strlen($cpf_cnpj); // pega quantidade de digitos
        if($qtdNumeros == '11'){
           // $faixa = \DB::connection('mysql2')->select("SELECT RIGHT(SUB_TIT, 1) as result FROM profiss WHERE CPF = '$cpf_cnpj' ");
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
                $totalDeJuros = calculatotalJuros($valorDaAnuidade, $anuidade_inicial, $anuidade_final, $anoAtual, $mesAtual);
                $totalDeMesesAtrasso = calculoDosMeses($anuidade_inicial, $anuidade_final, $anoAtual, $mesAtual);
                $total = $totalDeAnuidades + $totalDeMultas + $totalDeJuros;
            }
                $user->nome = $request->nome;
                $user->numero = $request->processo;
                $user->ef=$request->ef;
                $user->cpf_cnpj = $request->cpf_cnpj;
                $user->data_debito = $data;
                $user->anuidade_inicial = $request->anuidadeInicial;
                $user->anuidade_final = $request->anuidadeFinal;
                $user->valor_originario = $request->valorOriginario;
                $user->valor_atualizado = $request->valorAtualizado;
                $user->valor_anuidade_atualizado = 0;
                $user->valor_anuidade = $valorDaAnuidade;
                $user->valor_atualizado = $total;
                
                if($request->situacao == 1){
                    $user->ativo = 1;
                    $user->extinto = 0;
                    
                }elseif($request->situacao == 0){
                    $user->ativo = 0;
                    $user->extinto = 1;
                    
                }
                $user->save();
                session()->flash('sucess', 'PROFISSIONAL CADASTRADO COM SUCESSO!.');
            return redirect()->back();

        }
        elseif($qtdNumeros == '14'){
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
                $totalDeJuros = calculatotalJuros($valorDaAnuidade, $anuidade_inicial, $anuidade_final, $anoAtual, $mesAtual);
                $totalDeMesesAtrasso = calculoDosMeses($anuidade_inicial, $anuidade_final, $anoAtual, $mesAtual);
                $total = $totalDeAnuidades + $totalDeMultas + $totalDeJuros;
            }
            $user->nome = $request->nome;
            $user->numero = $request->processo;
            $user->ef=$request->ef;
            $user->cpf_cnpj = $request->cpf_cnpj;
            $user->data_debito = $data;
            $user->anuidade_inicial = $request->anuidadeInicial;
            $user->anuidade_final = $request->anuidadeFinal;
            $user->valor_originario = $request->valorOriginario;
            $user->valor_atualizado = $request->valorAtualizado;
            $user->valor_anuidade_atualizado = 0;
            $user->valor_anuidade = $valorDaAnuidade;
            $user->valore_atualizado = $total;
            
            if($request->situacao == 1){
                $user->ativo = 1;
                $user->extinto = 0;
                
            }elseif($request->situacao == 0){
                $user->ativo = 0;
                $user->extinto = 1;
                
            }
            $user->save();
            session()->flash('sucess', 'EMPRESA CADASTRADA COM SUCESSO!.');
            return redirect()->back();
        }
        else{
                session()->flash('msg', ' VERIFIQUE O CAMPO "CPF/CNPJ". O NÚMERO INFORMADO NÃO É UM CPF E NEM CNPJ VÁLIDO. ');
            return redirect()->back();
        }
        //session()->flash('msg', 'Cadastrado com sucesso!.');
        //return redirect()->back();
      /* $inpc = \DB::connection('mysql2')->select('SELECT RIGHT(SUB_TIT, 1) FROM profiss WHERE CPF = 5074064600 ');
       dd($inpc);*/


    }


    public function show(Anuidade $anuidade)
    {
       
    }

   

    public function edit(Anuidade $anuidade)
    {
        
    }

  
    public function update(Request $request, Anuidade $anuidade)
    {
        
    }
    public function destroy(Anuidade $anuidade)
    {
        
    }
}
