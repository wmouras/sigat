<?php

 function calculaTotalAnuidades($anuidade,$anuidade_inicial, $anuidade_final){
    $totalAnuidade = contarAnuidades($anuidade_inicial, $anuidade_final);
    $valorTotalAnuidade = $anuidade * $totalAnuidade;
    return $valorTotalAnuidade; // valor total de anuidades pendentes.
}

 function calculaTotalMultas($anuidade, $porcentagem, $anuidade_inicial, $anuidade_final){
        $totalAnuidade = contarAnuidades($anuidade_inicial, $anuidade_final);
        $multas = ($anuidade / 100) * $porcentagem;
        $totalMultas = $multas * $totalAnuidade;
        return $totalMultas; // valor total de multas.
}

 function calculaTotalJuros($anuidade, $anuidade_inicial, $anuidade_final, $dataAtual, $mes){
    $totalMeses = calculoDosMeses($anuidade_inicial, $anuidade_final, $dataAtual, $mes);
    $totalJuros = ($anuidade / 100) * $totalMeses;
    return $totalJuros; //valor total de juros.

}

 function calculoDosMeses($Anuidade_inicial, $Anuidade_final, $DataAtual, $mes){
       $totalMeses = '0';
    while($Anuidade_inicial <= $Anuidade_final){
        $anos = $DataAtual - $Anuidade_inicial;
        $meses = ($anos * 12) - 3 + $mes;
        $totalMeses = $totalMeses + $meses;
        $Anuidade_inicial = $Anuidade_inicial + 1;
    }
        return $totalMeses ;

}

function contaMes(){

}

function contarAnuidades($Anuidade_inicial, $Anuidade_final){
        $totalAnuidade = '0';
        while($Anuidade_inicial <= $Anuidade_final){
            $totalAnuidade = $totalAnuidade + 1;
            $Anuidade_inicial = $Anuidade_inicial + 1;
        }
        return $totalAnuidade;

}
 function variacaoInpc($valorAnuidade,$variacaoInpc){
    $inpc = $variacaoInpc / 100;
    $variacao = $valorAnuidade * $inpc;
    $variacaoAnuidade = $valorAnuidade + $variacao;
    $variacaoAnuidade = number_format($variacaoAnuidade,2,",",".");
    return $variacaoAnuidade;
}


 function verificaFaixa($capital){
    $faixa = '';
    if($capital <= 50000){
        $faixa = 1;
    }elseif($capital > 50000 && $capital <= 200000){
        $faixa = 2;
    }elseif($capital > 200000 && $capital <= 500000){
        $faixa = 3;
    }elseif($capital > 500000 && $capital <= 1000000){
        $faixa = 4;
    }elseif($capital > 1000000 && $capital <= 2000000){
        $faixa = 5;
    }elseif($capital > 2000000 & $capital <= 10000000){
        $faixa = 6;
    }elseif($capital > 10000000){
        $faixa = 7;
    }
    return $faixa;
}

 function indiceCorrecao($indiceAtual, $indiceAnterior){
    $correcao = $indiceAtual / $indiceAnterior;
    return $correcao;
}

 function correcaoMonetaria($indiceAtual, $indiceAnterior, $valorOriginal){
        $indiceCorrecao = indiceCorrecao($indiceAtual, $indiceAnterior);
        $correcaoMonetaria  = $valorOriginal * ($indiceCorrecao - 1);
        return $correcaoMonetaria; // valor total de multas.
}

 function juros($indiceAtual, $indiceAnterior, $valorOriginal, $mesesAtraso){
        $indiceCorrecao =indiceCorrecao($indiceAtual, $indiceAnterior);
        $juros = $valorOriginal * $indiceCorrecao * 0.01 *  $mesesAtraso;
        return $juros; // valor total de multas.
}

 function total($indiceAtual, $indiceAnterior, $valorOriginal, $mesesAtraso){
        $juros = juros($indiceAtual, $indiceAnterior, $valorOriginal, $mesesAtraso);
        $correcaoMonetaria = correcaoMonetaria($indiceAtual, $indiceAnterior, $valorOriginal);
        $total = $valorOriginal + $juros + $correcaoMonetaria;
        return $total;
}

function alteraValorBd( $valor ){
    $vl = str_replace('.', '', $valor);
    return str_replace(',', '.', $vl);
}

function apenasNumero( $valor ){
    return preg_replace('/[^0-9]/', '', $valor);
}
