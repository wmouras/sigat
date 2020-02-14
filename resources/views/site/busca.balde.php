@extends('site.home')
@section('pesquisa')


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
@foreach($resultado as $user)
      <td>$user->nome</td>
      <td>555550</td>
      <td>123</td>
      <td>01/02/2015</td>
      <td>R$: 250</td>
      <td>R$: 255</td>
      <td>Em divida Ativa</td>
      <td><a href="{{route('editarRegistro')}}"><button type="button" class="btn btn-primary" >Editar</button></a></td>
@endforeach
   </tr>


</table>
@endsection