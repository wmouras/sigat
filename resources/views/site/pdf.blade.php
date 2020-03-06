@extends('site.layout')
@section('conteudo')

<div class="form-group">
<button id="btn">Download</button>
</div>
<table id='tabela' class="table table-bordered">
    <tr>
        <td>Nome:</td>
        <td>Nº Processo</td>
        <td>EF</td>
        <td>Data do Débito</td>
        <td>Valor Originário</td>
        <td>Valor Atualizado</td>
        
    </tr>
    
    <!--<div class="alert alert-danger" role="alert">Teste</div>-->
    
        @foreach ($lista as $user)
        <tr>
            <td>{{$user->nome}}</td>
            <td>{{$user->numero}}</td>
            <td>{{$user->ef}}</td>
            <td>{{date('d/m/Y',strtotime($user->data_debito))}}</td>
            <td>R$: {{ number_format($user->valor_originario, 2, ',','.')}}</td>
            <td>R$: {{number_format($user->valor_atualizado, 2, ',','.')}}</td>
        </tr>
        @endforeach
    
    
   
   
</table>



<script type="text/javascript">
$('#btn').click(function(){
    $('#tabela').printThis();
})
   
</script>
@endsection