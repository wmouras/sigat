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
                <td>Nome:</td>
                <td>Nº Processo</td>
                <td>Data do Débito</td>
                <td>Valor Originário</td>
                <td>Anuidade Inicial</td>
                <td>Anuidade Final</td>
                <td>Total de Multas</td>
                <td>Total de Juros</td>
                <td>Valor Atualizado</td>
            </tr>
            
            <!--<div class="alert alert-danger" role="alert">Teste</div>-->
            
                @foreach ($lista as $user)
               
                <tr>
                    <td>{{$user["nome"]}}</td>
                    <td>{{$user["ef"]}}</td>
                    <td>{{date('d/m/Y',strtotime($user["dataDebito"]))}}</td>
                    <td>R$: {{ number_format($user["valorOriginal"], 2, ',','.')}}</td>
                    <td>{{$user["anuidadeInicial"]}}</td>
                    <td>{{$user["anuidadeFinal"]}}</td>
                    <td>R$: {{$user["totalMultas"]}}</td>
                    <td>R$: {{$user["totalJuros"]}}</td>
                    <td>R$: {{$user["valorAtualizado"]}}</td>
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