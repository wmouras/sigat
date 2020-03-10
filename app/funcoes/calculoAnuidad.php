<?php
//pega o ultimo id e cpf/cnpj
//id, cpf-cnpj
//===========================
/*if(cpf/cnpj == 11){
	//chama função 'buscar profissional' atraves do cpf/cnpj para saber a faixa da do profissional/empresa.
    $faixa =  buscarProfissional($cpf/cnpj) // selec no banco Recital na tabela profiss pegando o primeiro numero da direita da coluna sub_tit ex: RIGHT(SUB_TIT)
    $novaFaixa
	if($faixa == '1'||$faixa =='2'|| $faixa == '4'){
		$Novafaixa = "S";
	}elseif($faixa == '3'){
        $Novafaixa = "M"
    }

    $mes = '2';
    // pega anuidades inicial e final
    $anuidadeInicial, anuidadeFinal;
    //pega inpc pelo ano
    $Inpc = inpc($ano)
    $porcentagem = '20'// porcentagem ao ano.
    $valorDaAnuidade = buscarAnuidade($Novafaixa, $mes, $ano) /// pega a anuidade padrão do profissional 

    $totalAnuidades = calculaTotalAnuidades($valorAnuidade, $anuidadeInicial, $anuidadeFinal)

    $totalMultas = calculaTotalMultas($valorAnuidade, $porcentagem, $anuidadeInicial, $anuidadeFinal)

    $totalJuros = calculatotalJuros($valorAnuidade, $anuidadeInicial, $anuidadeFinal, $ano, $mesAtual)

    $variaçãoInpc = variacaoInpc($valorAnuidade, $Inpc)
    
    $totalMesesAtrasso = calculoDosMeses($anuidadeInicial, $anuidadeFinal, $ano, $mesAtual)	

    $total = totalAnuidade + $totalMultas = $totalJuros;
    
    //Cadastra já com valor atualizado.
    update tbanuidade set valor_atualizado = $total	

}elseif(cpf/cnpj == '14'){
		
		$capital = buscarEmpresa($cpf/cnpj) //pega o capital da empresa pelo cnpj
		
		$faixa = $verificarFaixa($capital) // descobre a faixa da empresa

		$mes = 2
		
		// pega anuidades inicial e final
		$anuidadeInicial, anuidadeFinal;

		//pega inpc pelo ano
		$Inpc = inpc($ano)

		$porcentagem = '20'// porcentagem ao ano.

		$valorDaAnuidade = buscarAnuidade($faixa, $mes, $ano) /// pega a anuidade padrão do profissional 

		$totalAnuidades = calculaTotalAnuidades($valorAnuidade, $anuidadeInicial, $anuidadeFinal)

		$totalMultas = calculaTotalMultas($valorAnuidade, $porcentagem, $anuidadeInicial, $anuidadeFinal)

		$totalJuros = calculatotalJuros($valorAnuidade, $anuidadeInicial, $anuidadeFinal, $ano, $mesAtual)

		$variaçãoInpc = variacaoInpc($valorAnuidade, $Inpc)
		
		$totalMesesAtrasso = calculoDosMeses($anuidadeInicial, $anuidadeFinal, $ano, $mesAtual)	

		$total = totalAnuidade + $totalMultas = $totalJuros;
		
		//Cadastra já com valor atualizado.
		
}*/