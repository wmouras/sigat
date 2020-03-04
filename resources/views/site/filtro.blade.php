@extends('site.layout')
@section('conteudo')

@if(Session::has('msg'))
  <div  class='alert alert-danger'><h4>{!! Session::has('msg') ? Session::get("msg") : '' !!}</h4></div>
@endif

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
    
    @if(isset($resultado))
    @foreach($resultado as $user)
        <tr>
            <td style="display:none">{{$user->id}}</td>
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
            <td><a href="{{route('editRegistro',['user'=>$user->id])}}"><button type="button" class="btn btn-primary" >Editar</button></a></td>
        </tr>
    @endforeach
    @endif

</table>

@endsection