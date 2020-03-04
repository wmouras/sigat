@extends('site.layout')

@section('conteudo')

@if(Session::has('msg'))
  <div  class='alert alert-success'><h4>{!! Session::has('msg') ? Session::get("msg") : '' !!}</h4></div>
@endif

<h2 style="margin-left:40%; margin-top:15px;margin-buttom:15px; ">Editar Registro</h2>
<div class="container well ">
    
<form class="form-horizontal" action="{{route('editarRegistro',['user'=>$user->id])}}" method="post">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">NOME *</label>
    <div class="col-sm-6">
      <input type="text" class="form-control"  placeholder="digite o nome completo" name="nome" value="{{$user->nome}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">CPF/CNPF *</label>
    <div class="col-sm-6">
      <input type="text" class="form-control"  placeholder="DIGITE O CPF/CNPJ" name="cpf_cnpj" value="{{$user->cpf_cnpj}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">PROCESSO</label>
    <div class="col-sm-6">
      <input type="text" class="form-control"  placeholder="Nº do Processo" name="numero" value="{{$user->numero}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">EF</label>
    <div class="col-sm-6">
      <input type="text" class="form-control"  placeholder="Nº do EF" name="ef" value="{{$user->ef}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">ANUIDADE INICIAL *</label>
    <div class="col-sm-6">
      <input type="text" class="form-control"  placeholder="Exemplo: 2019" name="anuidade_inicial" value="{{$user->anuidade_inicial}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">ANUIDADE FINAL *</label>
    <div class="col-sm-6">
      <input type="text" class="form-control"  placeholder="Exemplo: 2020" name="anuidade_final" value="{{$user->anuidade_final}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">VALOR ORIGINÁRIO</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="R$: 000.00" name="valor_originario" value="{{$user->valor_originario}}">
    </div>
  </div>

 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Editar</button>
    </div>
  </div>
</form>
</div>

@endsection