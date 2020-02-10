<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Anuidade;
use PDF;

class pdfController extends Controller
{
    public function gerarPdf(){
        //$lista = Anuidade::all();
        $lista = new Anuidade;
        $result=$lista::where('anuidade_inicial',2012)->get();
        return view('site.pdfAnuidade',[
            'lista' =>$result
        ]);
        //$lista = Anuidade::Raw('SELECT SUM(valor_originario)  FROM tb_anuidade WHERE ativo = 1')->get();
        //dd($lista);
        //$pdf = PDF::loadView('site.pdfAnuidade',[
          //  'lista' =>$lista,
        //]);
        //return $pdf->setPaper('a4')->stream('listaAnuidade.pdf');
    }
}
