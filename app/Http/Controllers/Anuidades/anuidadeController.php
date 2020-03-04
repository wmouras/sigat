<?php

namespace App\Http\Controllers\Anuidades;

use App\Anuidade;
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
        $dat = str_replace('/','-',$request->data_debito);
        $data = date('Y-m-d', strtotime($dat));
        
        $user = new Anuidade;
        $user->nome = $request->nome;
        $user->numero = $request->processo;
        $user->ef=$request->ef;
        $user->cpf_cnpj = $request->cpf_cnpj;
        $user->data_debito = $data;
        $user->anuidade_inicial = $request->anuidadeInicial;
        $user->anuidade_final = $request->anuidadeFinal;
        $user->valor_originario = $request->valorOriginario;
        $user->valor_atualizado = $request->valorAtualizado;
        $user->valor_anuidade = 0;
        $user->valor_anuidade_atualizado = 0;

        if($request->situacao == 1){
            $user->ativo = 1;
            $user->extinto = 0;
            
        }elseif($request->situacao == 0){
            $user->ativo = 0;
            $user->extinto = 1;
            
        }
        $user->save();
        
        session()->flash('msg', 'Cadastrado com sucesso!.');
        return redirect()->back();
    }


    public function show(Anuidade $anuidade)
    {
       
    }

    public function gerarPdfAno(Request $request){
        $ano = $request->inicial;
        $situacao = $request->situacao;
        $lista = new Anuidade;
        $result=$lista::where([['anuidade_inicial','=',$ano],['ativo',$situacao]])->get(); 
        
        return view('site.pdfAnuidade',[
            'lista' =>$result,
            'mensagem' =>'$mensagem'
        ]);
    }

    public function gerarPdfMes(Request $request){
        $mes = $request->mes;
        $lista = new Anuidade;
        $result=$lista::where('data_debito',$mes)->get();
        
        return view('site.pdfAnuidade',[
            'lista' =>$result
        ]);
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
