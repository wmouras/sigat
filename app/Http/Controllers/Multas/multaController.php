<?php

namespace App\Http\Controllers\Multas;

use App\Http\Controllers\Controller;
use App\Multa;
use Illuminate\Http\Request;

class multaController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new Multa;
        $user->nome = $request->nome;
        $user->numero = $request->processo;
        $user->ef=$request->ef;
        $user->cpf_cnpj = $request->cpf_cnpj;
        $user->data_debito = $request->data_debito;
        $user->valor_originario = $request->valorOriginario;
        $user->juros = 0.00;
        $user->correcaoMonetaria = 0.00;
        $user->valor_atualizado = $request->valorAtualizado;
 

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
        $mensagem = 'Anuidade Multa cadastrada!';
        return redirect()->route('home',[
            'mensagem' => $mensagem
        ]);
    }

  
    public function show(Multa $multa)
    {
        //
    }

    public function gerarPdfAno(Request $request){
        $ano = $request->inicial;
        $lista = new Multa;
        $result=$lista::where('anuidade_inicial',$ano)->get();
        return view('site.pdfAnuidade',[
            'lista' =>$result
        ]);
    }

    public function edit(Multa $multa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Multa  $multa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Multa $multa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Multa  $multa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Multa $multa)
    {
        //
    }
}
