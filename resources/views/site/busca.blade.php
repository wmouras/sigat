@extends('site.layout')
@section('conteudo')


<div class="form-group" style="margin-top:90px;">
           
            <a href="{{route('filtro')}}"><button type="submit" class="btn btn-primary">Limpar</button></a>
           
</div>

<div style="margin-left:40%;">
<h3>{{$mensagem}}</h3>
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
 
@foreach($resultado as $user)
<tr>
      <td>{{$user->nome}}</td>
      <td>{{$user->numero}}</td>
      <td>{{$user->ef}}</td>
      <td>{{$user->data_debito}}</td>
      <td>{{$user->valor_originario}}</td>
      <td>{{$user->valor_atualizado}}</td>
      @if ($user->ativo == 1)
      <td>Em dívida ativa</td>
      @else
      <td>Extinto</td>
      @endif
      <td><a href="{{route('editarRegistro')}}"><button type="button" class="btn btn-primary" >Editar</button></a></td>
     </tr>
@endforeach
 


</table>
@endsection