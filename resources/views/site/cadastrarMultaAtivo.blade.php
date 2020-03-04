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

<div class="container well ">
    <h2 style="margin-left:30%; margin-top:15px;margin-buttom:15px; ">CADASTRAR MULTA-ATIVO</h2>
<form action="{{route('formCadMulta')}}" class="form-horizontal" method="POST">
@csrf
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">NOME *</label>
    <div class="col-sm-6">
      <input type="text" name="nome" class="form-control" id="inputNome" placeholder="digite o nome completo" value="{{old('nome')}}" onkeyup="maiuscula(this)">
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
    <label for="inputPassword3" class="col-sm-2 control-label">VALOR ORIGINÁRIO</label>
    <div class="col-sm-6">
      <input type="text" name="valorOriginario" class="form-control" id="inputValorValorOriginario" placeholder="R$: 000.00" value="{{old('valorOriginario')}}">
      <p>Obs: Digite no formatado decimal. Ex: 1500.50</p>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">VALOR ATUALIZADO</label>
    <div class="col-sm-6">
      <input type="text" name="valorAtualizado" class="form-control" id="inputValorAtualizado" placeholder="R$: 000.00" value="{{old('valorAtualizado')}}">
      <p>Obs: Digite no formatado decimal. Ex: 1500.50</p>
    </div>
  </div>

  <div class="form-group" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">ativo</label>
    <div class="col-sm-6">
      <input type="text" name="situacao" class="form-control" id="inputAtivo" value="1">
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