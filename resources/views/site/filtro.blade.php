@extends('site.layout')
@section('conteudo')

@if(Session::has('msg'))
  <div  class='alert alert-danger'><h4>{!! Session::has('msg') ? Session::get("msg") : '' !!}</h4></div>
@endif

@if(Session::has('sucess'))
  <div  class='alert alert-success'><h4>{!! Session::has('sucess') ? Session::get("sucess") : '' !!}</h4></div>
@endif

@if(Session::has('falid'))
  <div  class='alert alert-danger'><h4>{!! Session::has('falid') ? Session::get("falid") : '' !!}</h4></div>
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


<table class="table table-hover table-dark">
  <tr>
      <td>Nome</td>
      <td>Processo</td>
      <td>Ef</td>
      <td>Data do Débito</td>
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
            <td>{{date('d/m/Y',strtotime($user->data_debito))}}</td>
            <td>R$: {{number_format($user->valor_originario, 2, ',','.')}}</td>
            <td>R$: {{number_format($user->valor_atualizado, 2, ',','.')}}</td>
            @if ($user->ativo == 1)
            <td class="table-danger">Em dívida ativa</td>
            @else
            <td class="table-warning">Extinto</td>
            @endif
            <td>            
                <a href="{{route('editRegistro',['user'=>$user->id, 'opcao' => 'anuidade', 'id'=>$user->id])}}" class="btn btn-primary" >Editar</a>            
            </td>
            <td>
                <a href="{{route('excluirRegistro',['user'=>$user->id, 'opcao' => 'anuidade', 'id'=>$user->id])}}" class="btn btn-danger" >Excluir</a>
            </td>
        </tr>
    @endforeach
    @endif

</table>

@endsection