@extends('site.layout')

@section('conteudo')

<div class="container well ">
    <h2 style="margin-left:25%; margin-top:15px;margin-buttom:15px; ">CADASTRAR MULTA-EXTINTO <MULTA-EXTINTO></MULTA-EXTINTO></h2>
<form action="{{route('formCadMulta')}}" class="form-horizontal" method="POST">
@csrf
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">NOME *</label>
    <div class="col-sm-6">
      <input type="text" name="nome" class="form-control" id="inputNome" placeholder="digite o nome completo">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">CPF/CNPJ *</label>
    <div class="col-sm-6">
      <input type="text" name="cpf_cnpj" class="form-control" id="inputCpf/cnpf" placeholder="DIGITE O CPF/CNPJ">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">PROCESSO</label>
    <div class="col-sm-6">
      <input type="text" name="processo" class="form-control" id="inputProcesso" placeholder="Nº do Processo">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">DATA DO DÉBITO</label>
    <div class="col-sm-6">
      <input type="text" name="data_debito" class="form-control" id="inputDataDebito" placeholder="Exemplo: 01/02/2020">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">EF</label>
    <div class="col-sm-6">
      <input type="text" name="ef" class="form-control" id="inputEf" placeholder="Nº do EF">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">VALOR ORIGINÁRIO</label>
    <div class="col-sm-6">
      <input type="text" name="valorOriginario" class="form-control" id="inputValorValorOriginario" placeholder="R$: 000,00">
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">VALOR ATUALIZADO</label>
    <div class="col-sm-6">
      <input type="text" name="valorAtualizado" class="form-control" id="inputValorAtualizado" placeholder="R$: 000.00">
    </div>
  </div>

  <div class="form-group" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">ativo</label>
    <div class="col-sm-6">
      <input type="text" name="situacao" class="form-control" id="inputAtivo" value="0">
    </div>
  </div>

 
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
  </div>
</form>
</div>

@endsection