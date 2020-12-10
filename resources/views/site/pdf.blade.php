@extends('site.layout')
@section('conteudo')

<div class="form-group">
<button id="btn">Imprimir</button>
</div>

<div id='section' class="col-sm-12 col-md-12 well" id="content">
<div class="form-group">
    <h3>Total R$: {{number_format($total, 2, ',','.')}}</h3>
</div>




        <table id='tabela' class="table table-bordered">
            <tr>
                <th width="40%">Nome:</th>
                <th>Nº Processo</th>
                <th>Data do Débito</th>
                <th>Valor Originário</th>
                @if($tipo != 'multa')
                <th>Anuidade Inicial</th>
                <th>Anuidade Final</th>
                <th>Total de Multas</th>
                <th>Total de Juros</th>
                @endif
                <th>Valor Atualizado</th>
            </tr>
            
            <!--<div class="alert alert-danger" role="alert">Teste</div>-->
            
                @foreach ($lista as $user)
               
                <tr>
                    <td>{{$user["nome"]}}</td>
                    <td>{{$user["ef"]}}</td>
                    <td>{{date('d/m/Y',strtotime($user["dataDebito"]))}}</td>
                    <td>R$: {{ number_format($user["valorOriginal"], 2, ',','.')}}</td>
                    @if($tipo != 'multa')
                    <td>{{$user["anuidadeInicial"]}}</td>
                    <td>{{$user["anuidadeFinal"]}}</td>
                    <td>R$: {{$user["totalMultas"]}}</td>
                    <td>R$: {{$user["totalJuros"]}}</td>
                    @endif
                    <td>R$: {{ number_format($user["valorAtualizado"], 2, ',', '.')}}</td>
                </tr>
                @endforeach

        </table>
   
</div>


<script type="text/javascript">
document.getElementById('btn').onclick = function() {
            var conteudo = document.getElementById('section').innerHTML,
                tela_impressao = window.open('about:blank');
                tela_impressao.document.write(conteudo);
                tela_impressao.window.print();
                tela_impressao.window.close();
        };
</script>
@endsection