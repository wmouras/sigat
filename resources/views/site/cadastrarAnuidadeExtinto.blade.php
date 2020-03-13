@extends('site.layout')

@section('conteudo')

@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>

  </div>
@endif

@if(Session::has('msg'))
  <div  class='alert alert-danger'><h3>{!! Session::has('msg') ? Session::get("msg") : '' !!}</h3></div>
@endif

@if(Session::has('sucess'))
  <div  class='alert alert-success'><h3>{!! Session::has('sucess') ? Session::get("sucess") : '' !!}</h3></div>
@endif

<div class="container well">
<h2 style="margin-left:25%; margin-top:15px;margin-buttom:15px; ">CADASTRAR ANUIDADE-EXTINTO</h2>
<form action="{{route('formCadAnuidade')}}" class="form-horizontal" method="POST">
@csrf
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">NOME *</label>
    <div class="col-sm-6">
      <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Nome Completo" value="{{old('nome')}}" onkeyup="maiuscula(this)">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">CPF/CNPJ *</label>
    <div class="col-sm-6">
      <input type="text" name="cpf_cnpj" class="form-control" id="inputCpf/cnpf" placeholder="DIGITE O CPF/CNPJ" value="{{old('cpf_cnpj')}}">
      <p>Obs:Digite sem pontos, traços ou barras. Ex: 1234567891011</p>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">PROCESSO</label>
    <div class="col-sm-6">
      <input type="text" name="processo" class="form-control" id="inputProcesso" placeholder="Nº do Processo" value="{{old('processo')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">DATA DO DÉBITO</label>
    <div class="col-sm-6">
      <input type="text" name="data_debito" class="form-control" id="inputDataDebito" placeholder="Exemplo: 01/02/2020" value="{{old('data_debito')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">EF</label>
    <div class="col-sm-6">
      <input type="text" name="ef" class="form-control" id="inputEf" placeholder="Nº do EF" value="{{old('ef')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">ANUIDADE INICIAL *</label>
    <div class="col-sm-6">
      <input type="text" name="anuidadeInicial" class="form-control" id="inputAnuidadeInicial" placeholder="Exemplo: 2019" value="{{old('anuidadeInicial')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">ANUIDADE FINAL *</label>
    <div class="col-sm-6">
      <input type="text" name="anuidadeFinal" class="form-control" id="inputValorAnuidadeFinal" placeholder="Exemplo: 2020" value="{{old('anuidadeFinal')}}">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">VALOR ORIGINÁRIO</label>
    <div class="col-sm-6">
      <input type="text" name="valorOriginario" class="form-control" id="inputValorValorOriginario" placeholder="R$: 000.00" value="{{old('valorOriginario')}}">
      <p>Obs: Digite no formatado decimal. Ex: 1500.50</p>
    </div>
  </div>

  <div class="form-group" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">extinto</label>
    <div class="col-sm-6">
      <input type="text" name="situacao" class="form-control" id="inputExtinto" value="0">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
  </div>
</form>
</div>
<script>
function maiuscula(z){
    v = z.value.toUpperCase();
    z.value = v;
}
</script>
@endsection