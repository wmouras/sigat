<?php

namespace App\Http\Controllers\Multas;

use App\Http\Controllers\Controller;
use App\Multa;
use Illuminate\Http\Request;
use App\Http\Requests\MultaRequest;
use Exception;

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
        $dat = str_replace('/','-',$request->data_debito);
        $data = date('Y-m-d', strtotime($dat));
        $ano = date('Y',strtotime($data));
        $mes = date('m',strtotime($data));
        $mesAnterior = $mes - 1;
        $anoAnterior = $ano;
        /// Datas atuais
        $anoAtual = date('Y');
        $mesAt = date('m');
        $mesAtual = $mesAt - 1;

        if($mesAnterior == 0){
            $mesAnterior = 12;
            $anoAnterior -= 1;
        }

        if($mesAnterior == 0){
            $mesAtual = 12;
            $anoAtual -= 1;
        }

        try{
            $indAtual = \DB::connection('mysql3')->table('inpc')->select('numero_indice')->where('mes', $mesAtual)->where('ano', $anoAtual)->get();
            $indAt = $indAtual[0];
        }catch(Exception $e){
            session()->flash('msg', 'INPC do mês não cadastrado. favor contatar a ATI.');
        }

        $indiceAtual = $indAt->numero_indice;

        $indAnt = \DB::connection('mysql3')->table('inpc')->select('numero_indice')->where('mes',$mesAnterior)->where('ano', $anoAnterior)->get();
        $indAnte = $indAnt[0];
        $indiceAnterior = $indAnte->numero_indice;

        //Meses em atrasso
        $a1 = ($anoAtual - $ano) * 12;
        $m1 = ($mesAtual - $mesAnterior) * -1;
        $mesesAtraso = ($m1 + $a1);

        $request->valorOriginario = alteraValorBd($request->valorOriginario);

        $total = total($indiceAtual, $indiceAnterior, $request->valorOriginario, $mesesAtraso);
        $jurosMulta = juros($indiceAtual, $indiceAnterior, $request->valorOriginario, $mesesAtraso);
        $correcaoMonetaria = correcaoMonetaria($indiceAtual, $indiceAnterior, $request->valorOriginario);


        //dd($indiceAtual, $indiceAnterior, $a1, $m1,$mesesAtraso, $total, $jurosMulta, $correcaoMonetaria);

        $user = new Multa;
        $user->nome = $request->nome;
        $user->numero = $request->processo;
        $user->ef= ltrim( $request->ef, '0');
        $user->cpf_cnpj = preg_replace('/[^0-9]/', '', $request->cpf_cnpj);
        $user->data_debito = $data;
        $user->valor_originario = $request->valorOriginario;
        $user->juros = $jurosMulta;
        $user->correcaoMonetaria = $correcaoMonetaria;
        $user->valor_atualizado = $total;


        if($request->situacao == 1){
            $user->ativo = 1;
            $user->extinto = 0;

        }elseif($request->situacao == 0){
            $user->ativo = 0;
            $user->extinto = 1;

        }

        try{
            $user->save();
            return redirect('home');
        }catch(Excepion $e){
            echo 'Exceção: ',  $e->getMessage(), "\n";
        }


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
