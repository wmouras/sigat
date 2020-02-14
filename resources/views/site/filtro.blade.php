@extends('site.layout')
@section('conteudo')
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
<table class="table table-hover">
  <tr>
      <td>Nome</td>
      <td>Processo</td>
      <td>Ef</td>
      <td>Data do Debito</td>
      <td>Valor Originário</td>
      <td>Valor Atualizado</td>
      <td>Situação</td>
      <td>Ação</td>
  </tr>
  <tr>
      <td>nome</td>
      <td>555550</td>
      <td>123</td>
      <td>01/02/2015</td>
      <td>R$: 250</td>
      <td>R$: 255</td>
      <td>Em divida Ativa</td>
      <td><a href="{{route('editarRegistro')}}"><button type="button" class="btn btn-primary" >Editar</button></a></td>
   </tr>
</table>
@endsection