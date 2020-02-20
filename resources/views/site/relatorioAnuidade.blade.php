@extends('site.layout')
@section('conteudo')

<!------ Include the above in your HEAD tag ---------->
<style>
.card-container {
 
  perspective: 1000px;
  -webkit-perspective: 1000px;
  -moz-perspective: 1000px;
  transform-style: preserve-3d;
}
.card-container.flipped .front {
  transform: rotateY(180deg);
}
.card-container.flipped .back {
  transform: rotateY(360deg);
}
.card-container, .front, .back {
  width: 100%;
  height: 250px;
}
.flipper {
  transform-style: preserve-3d;
  position: relative;
}
.front, .back {
  backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
  -moz-backface-visibility: hidden;
  transition: 3s;
  transform-style: preserve-3d;
  position: absolute;
  top: 0;
  left: 0;
}
.front {
  z-index: 2;
  transform: rotateY(0deg);
  -webkit-transform: rotateY(0deg);
  -ms-transform: rotateY(0deg);
  -moz-transform: rotateY(0deg);
}
.back {
  transform: rotateY(180deg);
  -webkit-transform: rotateY(180deg);
  -ms-transform: rotateY(180deg);
  -moz-transform: rotateY(180deg);
}
#pdf{
    width: 70px;
    height: 60px; 
    border-radius: 10px;
}
#cardAnual{
    display:flex;
    justify-content: space-around;
}
#itens{
  display: flex;
  justify-content: space-around;
  height:100%;
}
div#optSelect{
    margin:5%;
}
</style>
<h1 style="margin-left:32%;">Relátorios Anuidades</h1>
<div id="itens" class="container-fluid well">

<!-- Card 1 -->  
<div class="col-lg-4 col-md-4 col-sm-6 col-sm-6 col-xs-12">
    <div class="card-container">
        <div class="flipper">
            <div class="front">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div id="cardAnual" class="row">
                             <div class="col-md-3">	
                                <img id="pdf" src="imagens/pdf.png" alt="">
                            </div>

                            <div>	
                                <h3>Relatório Anual</h3>
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-body text-center">
                        <div class="col-md-4 mb-6" id="optSelect">
                          <label for="inputGroupSelect01" class=" col-form-label">SITUAÇÃO:</label>
                          <select name="selectAnuidadeAnual" class="custom-select" id="selectAnuidadeAnual" required >
                            <option selected>Selecione...</option>
                            <option value="AnuidadeAtivo">Em Dívida Ativa</option>
                            <option value="AnuidadeExtinto">Extintos</option>
                          </select>
                        </div>  
                    
                    <form style ="display:none;" id="form1AnuidadeAnual" action="{{route('pdfAnuidadeAno')}}" class="form-inline" method="POST">
                    @csrf
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">Anuidade inicial</div>
                            <input type="text" name="inicial" class="form-control" placeholder="Exemplo 2019">
                            </div>
                        </div>
                        <div style="display:none;" class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">valor</div>
                            <input type="text" name="situacao" class="form-control" value="1">
                            </div>
                        </div>

                       <hr>
                        <button  type="submit" class="btn btn-primary">Filtrar</button>
                    </form>

                    <form style="display:none;" id="form2AnuidadeAnual" action="{{route('pdfAnuidadeAno')}}" class="form-inline" method="POST">
                    @csrf
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">Anuidade inicial</div>
                            <input type="text" name="inicial" class="form-control"  >
                            </div>
                        </div>
                        <div style="display:none;" class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">valor</div>
                            <input type="text" name="situacao" class="form-control" value="0">
                            </div>
                        </div>

                     
                       <hr>
                        <button  type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                    </div>
                </div>
            </div>
      </div>
    </div>
    
</div>
<!-- Card 1 -->  
<!-- Card 2 -->  
<div class="col-lg-4 col-md-4 col-sm-6 col-sm-12 col-xs-12">
    <div class="card-container">
        <div class="flipper">
            <div class="front">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div id="cardAnual" class="row">
                             <div class="col-md-3">	
                                <img id="pdf" src="imagens/pdf.png" alt="">
                            </div>

                            <div>	
                                <h3>Relatório Mensal</h3>
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-body text-center">
                        <div class="col-md-4 mb-6" id="optSelect">
                          <label for="inputGroupSelect01" class=" col-form-label">SITUAÇÃO:</label>
                          <select name="selectAnuidadeMes" class="custom-select" id="selectAnuidadeMes" required >
                            <option selected>Selecione...</option>
                            <option value="AnuidadeAtivo">Em Dívida Ativa</option>
                            <option value="AnuidadeExtinto">Extintos</option>
                          </select>
                        </div>  
                    <form style="display:none;" id="form1AnuidadeMes" action="{{route('pdfAnuidadeMes')}}" class="form-inline" method="POST">
                    @csrf
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">Anuidade inicial</div>
                            <input type="text" name='mes' class="form-control" id="exampleInputAmount" placeholder="Exemplo 01/2019">
                            </div>
                        </div>
                        <div style="display:none;" class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">valor</div>
                            <input type="text" name="situacao" class="form-control" value="1">
                            </div>
                        </div>

                       <hr>
                        <button  type="submit" class="btn btn-primary">Filtrar</button>
                    </form>
                    <form style="display:none;" id="form2AnuidadeMes" action="{{route('pdfAnuidadeMes')}}" class="form-inline" method="POST">
                    @csrf
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">Anuidade inicial</div>
                            <input type="text" name='mes' class="form-control" id="exampleInputAmount" placeholder="Exemplo ">
                            </div>
                        </div>

                        <div style="display:none;" class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">valor</div>
                            <input type="text" name="situacao" class="form-control" value="0">
                            </div>
                        </div>

                       <hr>
                        <button  type="submit" class="btn btn-primary">Filtrar</button>
                    </form>
                    </div>
                </div>
            </div>
            
      </div>
    </div>
    
</div>
<!-- Card 2 -->  

<!-- Card 3 -->  
<div class="col-lg-4 col-md-4 col-sm-6 col-sm-12 col-xs-12">
    <div class="card-container">
        <div class="flipper">
            <div class="front">
            <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div id="cardAnual" class="row">
                             <div class="col-md-3">	
                                <img id="pdf" src="imagens/pdf.png" alt="">
                            </div>

                            <div>	
                                <h3>RELATÓRIO TODOS</h3>
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-body text-center">
                    <div class="col-md-4 mb-6" id="optSelect">
                          <label for="inputGroupSelect01" class=" col-form-label">SITUAÇÃO:</label>
                          <select name="selectAnuidadeTodos" class="custom-select" id="selectAnuidadeTodos" required >
                            <option selected>Selecione...</option>
                            <option value="AnuidadeAtivo">Em Dívida Ativa</option>
                            <option value="AnuidadeExtinto">Extintos</option>
                          </select>
                        </div>  
                    <form style="display:none;" id="form1AnuidadeTodos" action="" class="form-inline" method="POST">
                    @csrf
                    <div style="display:none;" class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">valor</div>
                            <input type="text" name="situacao" class="form-control" value="ativo">
                            </div>
                        </div>
    
                        <button  type="submit" class="btn btn-primary">Filtrar Ativos</button>
                    </form>

                    <form style="display:none;" id="form2AnuidadeTodos" action="" class="form-inline" method="POST">
                    @csrf
                    <div style="display:none;" class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">valor</div>
                            <input type="text" name="situacao" class="form-control" value="extinto">
                            </div>
                        </div>
    
                        <button  type="submit" class="btn btn-primary">Filtrar Extinos</button>
                    </form>
                    </div>
                </div>
            </div>
            
      </div>
    </div>
    
</div>

</div>

<script>
//SELECT RELÁTORIO ANUIDADES
$(document).on('click', '#selectAnuidadeAnual', function(){
  var tipoCade = $('#selectAnuidadeAnual').val();
  
  if(tipoCade == 'AnuidadeAtivo'){
    $('#form1AnuidadeAnual').css('display','block')
    $('#form2AnuidadeAnual').css('display','none')


  }else if(tipoCade == 'AnuidadeExtinto'){
    
    $('#form1AnuidadeAnual').css('display','none')
    $('#form2AnuidadeAnual').css('display','block')
  }
});


//SELECT RELÁTORIO MULTAS
$(document).on('click', '#selectAnuidadeMes', function(){
  var tipoCade = $('#selectAnuidadeMes').val();
  
  if(tipoCade == 'AnuidadeAtivo'){
    $('#form1AnuidadeMes').css('display','block')

    $('#form2AnuidadeMes').css('display','none')

  }else if(tipoCade == 'AnuidadeExtinto'){
    
    $('#form1AnuidadeMes').css('display','none')
    $('#form2AnuidadeMes').css('display','block')
  }
});

//SELECT RELÁTORIO TODOS
$(document).on('click', '#selectAnuidadeTodos', function(){
  var tipoCade = $('#selectAnuidadeTodos').val();
  
  if(tipoCade == 'AnuidadeAtivo'){
    $('#form1AnuidadeTodos').css('display','block')

    $('#form2AnuidadeTodos').css('display','none')

  }else if(tipoCade == 'AnuidadeExtinto'){
    
    $('#form1AnuidadeTodos').css('display','none')
    $('#form2AnuidadeTodos').css('display','block')
  }
});
</script>
@endsection