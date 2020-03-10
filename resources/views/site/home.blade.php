@extends('site.layout')
@section('conteudo')
<style>
.row{
    margin-top:30px;
    display: flex;
    justify-content: space-between;
}
div#section{
     background-color: #F23005;
        -webkit-box-shadow: 1px 1px 5px rgba(50, 50, 50, 0.77);
        -moz-box-shadow:    1px 1px 5px rgba(50, 50, 50, 0.77);
        box-shadow:         1px 1px 5px rgba(50, 50, 50, 0.77)
}
img#img-acessoRapido{
    width: 50px;
    height: 50px;
}

</style>

<div id='section' class="col-sm-12 col-md-12 well" id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">	
                <div class="panel panel-danger">
                    <div style="text-align: center;" class="panel-heading"><h4>TOTAL DE ANUIDADES-ATIVOS</h4></div>
                    <div style="text-align: center;" class="panel-body"><h2>R$: {{number_format($totalAnuidade, 2, ',','.')}}</h2></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-danger">
                    <div style="text-align: center;" class="panel-heading"><h4>TOTAL DE MULTAS-ATIVOS</h4></div>
                    <div style="text-align: center;" class="panel-body"><h2>R$: {{number_format($totalMulta, 2, ',','.')}}</h2></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">	
                <div class="panel panel-success">
                    <div style="text-align: center;" class="panel-heading"><h4> TOTAL DE ANUIDADES-EXTINTOS</h4></div>
                    <div style="text-align: center;" class="panel-body"><h2>R$: {{number_format($totalAnuidadeExinto, 2, ',','.')}}</h2></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div style="text-align: center;" class="panel-heading"><h4>TOTAL DE MULTAS-EXTINTOS</h4></div>
                    <div style="text-align: center;" class="panel-body"><h2>R$: {{number_format($totalMultaExinto, 2, ',','.')}}</h2></div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
 

<h3 style="margin-left:40%;">ACESSO RÁPIDO</h3>
<div id='section' class="col-sm-12 col-md-12 well" id="content">
    <div class="container">
            <div class="row">
              <div style=" width:270px; " class="col-md-4 text-center">
                  <div id="divImg">
                       <img  id='img-acessoRapido' src="imagens/cadastrarProc.png" alt="profisional">
                  </div>
                  <h4>Cadastrar Anuidade (Ativo)</h4>
                  <p id='links' class="text-center"><a href="{{route('anuidadeAtivo')}}" class="btn btn-default btn-lg">Acessar</a></p>
              </div>

              <div style=" width:270px;" class="col-md-4 text-center">
                  <img  id='img-acessoRapido' src="imagens/cadastrarProc.png" alt="empresa">
                  <h4>Cadastrar Multa (Ativo)</h4>
                  <center><p class="text-center"><a  href="{{route('multaAtivo')}}" class="btn btn-default btn-lg">Acessar</a></p></center>
              </div>

              <div style=" width:270px;" class="col-md-4 text-center">
                  <img  id='img-acessoRapido' src="imagens/consultarProc.png" alt="Formulário">
                  <h4>Buscar Dívida</h4>
                  <center><p class="text-center"><a  href="{{route('filtro')}}" class="btn btn-default btn-lg">Acessar</a></p></center>
              </div> 

              <div style=" width:270px;" class="col-md-4 text-center">
                  <img  id='img-acessoRapido' src="imagens/pdf.png" alt="Formulário">
                  <h4>Relatório Anuidade</h4>
                  <center><p class="text-center"><a  href="{{route('rAnuidade')}}" class="btn btn-default btn-lg">Acessar</a></p></center>
              </div>

              <div style=" width:270px;" class="col-md-4 text-center">
                  <img  id='img-acessoRapido' src="imagens/pdf.png" alt="Formulário">
                  <h4>Relatório Multa</h4>
                  <center><p class="text-center"><a  href="{{route('rMulta')}}" class="btn btn-default btn-lg">Acessar</a></p></center>
              </div>       
            </div>
    </div>
</div>


@endsection