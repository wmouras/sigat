<?php

namespace App\Http\Controllers\Anuidades;

use App\Anuidade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $user = new Anuidade;
        $user->nome = $request->nome;
        $user->numero = $request->processo;
        $user->ef=$request->ef;
        $user->cpf_cnpj = $request->cpf_cnpj;
        $user->data_debito = $request->data_debito;
        $user->anuidade_inicial = $request->anuidadeInicial;
        $user->anuidade_final = $request->anuidadeFinal;
        $user->valor_originario = $request->valorOriginario;
        $user->valor_atualizado = $request->valorAtualizado;
        $user->valorAnuidade = 0.00;
        $user->valorAnuidadeAtualizado = 0.00;

        if($request->situacao == 1){
            $user->ativo = 1;
            $user->extinto = 0;
            $user->quitado = 0;
        }elseif($request->situacao == 0){
            $user->ativo = 0;
            $user->extinto = 1;
            $user->quitado = 0;
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
        $lista = new Anuidade;
        $result=$lista::where('anuidade_inicial',$ano)->get(); 
        $mensagem = 'achou';
           if(empty($result)){
               $mensagem ='nada';
           }
        return view('site.pdfAnuidade',[
            'lista' =>$result,
            'mensagem' =>$mensagem
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
