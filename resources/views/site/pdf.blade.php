

<div class="form-group">
<h3>Lista de {{$situacao}}</h3>
</div>
<table id='tabela' class="table table-bordered">
    <tr>
        <td>Nome:</td>
        <td>Nº Processo</td>
        <td>EF</td>
        <td>Data do Débito</td>
        <td>Valor Originário</td>
        <td>Total</td>
        
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

