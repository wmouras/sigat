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
      <p>Obs:Digite sem pontos, traços ou barras. Ex: 1234567891011</p>
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
    <label for="inputPassword3" class="col-sm-2 control-label">VALOR ORIGINÁRIO R$:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="R$: 000.00" name="valor_originario" value="{{$user->valor_originario}}">
      <p>Obs: Digite no formatado decimal. Ex: 1500.50</p>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">STATUS:</label>
    <div class="col-sm-6">
    <p>{{$situacao}}</p>
    </div>
  </div>

  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">SITUAÇÃO ATUAL:</label>
    <div class="col-sm-6">
    <select name="selectAnuidade" class="custom-select is-invalid" id="selectAnuidade">
        <option selected>SELECIONE</option>
        <option value="1">EM DÍVIDA ATIVA</option>
        <option value="0">EXTINTO</option>
      </select>
    </div>
  </div>

  <div class="form-group" style="display:none" id="inputValorRecebido">
    <label for="inputPassword3" class="col-sm-2 control-label">VALOR RECEBIDO R$:</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" placeholder="R$: 000.00" name="valor_recebido" value="{{$user->valor_atualizado}}">
      <p>Obs: Digite no formatado decimal. Ex: 1500.50</p>
    </div>
  </div>

  <div class="form-group" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">opcao</label>
    <div class="col-sm-6">
      <input type="text" class="form-control"  name="opcao" value="anuidade">
      <input type="text" class="form-control"  name="id" value="{{$user->id}}">
    </div>
  </div>

 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Editar</button>
    </div>
  </div>
</form>
</div>

<script>
$(document).on('click', '#selectAnuidade', function(){
  var tipoCade = $('#selectAnuidade').val();
  if(tipoCade == '1'){
    $('#inputValorRecebido').css('display','none')
  }else if(tipoCade == '0'){
    $('#inputValorRecebido').css('display','block')
  }
});
</script>



@endsection