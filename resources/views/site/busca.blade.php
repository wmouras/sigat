@extends('site.layout')
@section('conteudo')


<div class="form-group" style="margin-top:90px;">
           
            <a href="{{route('filtro')}}"><button type="submit" class="btn btn-primary">Limpar</button></a>
           
</div>

<div style="margin-left:40%;">
<h3>{{$mensagem}}</h3>
</div>

@endsection