<?php

namespace App\Http\Controllers\Multas;

use App\Http\Controllers\Controller;
use App\Multa;
use Illuminate\Http\Request;
use App\Http\Requests\MultaRequest;

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
    public function store(MultaRequest $request)
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
        return redirect()->route('home');
    }

  
    public function show(Multa $multa)
    {
        //
    }

    public function edit(Multa $multa)
    {
        //
    }

    
    public function update(Request $request, Multa $multa)
    {
        //
    }

   
    public function destroy(Multa $multa)
    {
        //
    }
}
