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

@endsection