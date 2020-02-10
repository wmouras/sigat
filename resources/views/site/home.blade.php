@extends('site.layout')
@section('conteudo')

    <div style="margin-left:1%; margin-top:30px;" class="row">
        
        <div class="col-md-3">	
            <div class="panel panel-danger">
                <div style="text-align: center;" class="panel-heading">TOTAL DE ANUIDADES ATIVOS</div>
                <div style="text-align: center;" class="panel-body">R$: {{$totalAnuidade}}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-danger">
                <div style="text-align: center;" class="panel-heading">TOTAL DE MULTAS ATIVOS</div>
                <div style="text-align: center;" class="panel-body">R$: {{$totalMulta}}</div>
            </div>
        </div>
        <div class="col-md-3">	
            <div class="panel panel-success">
                <div style="text-align: center;" class="panel-heading">ANUIDADES RECEBIDAS</div>
                <div style="text-align: center;" class="panel-body">R$: 8.000,00</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-success">
                <div style="text-align: center;" class="panel-heading">MULTAS RECEBIDAS</div>
                <div style="text-align: center;" class="panel-body">R$:1.000.021,00</div>
            </div>
        </div>
        
    </div>

    <div class="alert alert-success" role="alert">{{$mensagem??''}}</div>
<div class="form-group" style="margin-top:90px;">
<form class="form-inline" action="{{route('buscarUsuario')}}" method="POST">
@csrf
  <div class="form-group">
    <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
    <div class="input-group">
    <select name="select" class="form-control">
    <option>Selecione</option>
    <option value="anuidade">Anuidade</option>
    <option value="multa">Multa</option>

    </select>
      <div class="input-group-addon"></div>
      <input type="text" name="busca" class="form-control" id="exampleInputAmount" placeholder="Digite o nome">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Pesquisar</button>
</form>
</div>
@endsection