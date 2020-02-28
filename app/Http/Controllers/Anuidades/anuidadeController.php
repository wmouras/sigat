<?php

namespace App\Http\Controllers\Anuidades;

use App\Anuidade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AnuidadeRequest;

class anuidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cadastrarAnuidade');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnuidadeRequest $request)
    {

        $data = date('Y-m-d', strtotime($request->data_debito));
        $valor_originario = str_replace(',','',$request->valorOriginario);
        
        $user = new Anuidade;
        $user->nome = $request->nome;
        $user->numero = $request->processo;
        $user->ef=$request->ef;
        $user->cpf_cnpj = $request->cpf_cnpj;
        $user->data_debito = $data;
        $user->anuidade_inicial = $request->anuidadeInicial;
        $user->anuidade_final = $request->anuidadeFinal;
        $user->valor_originario = $valor_originario;
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
        $mensagem = 'Anuidade Cadastrada!';
        return redirect()->route('home',[
            'mensagem' => $mensagem
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anuidade  $anuidade
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anuidade  $anuidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Anuidade $anuidade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anuidade  $anuidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anuidade $anuidade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anuidade  $anuidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anuidade $anuidade)
    {
        //
    }
}
