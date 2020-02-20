@extends('site.layout')

@section('conteudo')
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
</style>
<h1 style="margin-left:32%;">Relátorios Multas</h1>
<div id="itens" class="container-fluid well">
<!-- Card 1 -->  
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
                                <h3>Relatório Anual</h3>
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-body text-center">
                    <form class="form-inline" action="{{route('pdfMultaAno')}}" class="form-inline" method="POST">
                    @csrf
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">Mês inicial</div>
                            <input type="text" class="form-control" id="exampleInputAmount" placeholder="Exemplo 2019">
                            </div>
                        </div>

                        <div style="margin-top: 20px;" class="form-group">
                           <div class="input-group">
                           <div class="input-group-addon">Mês Final&nbsp;</div>
                           <input type="text" class="form-control" id="exampleInputAmount" placeholder="Exemplo 2020">
                           </div>
                       </div>
                       <hr>
                        <button  type="submit" class="btn btn-primary">Gerar PDF</button>
                    </form>
                    </div>
                </div>
            </div>
            
        <div class="back">
                <div class="panel panel-primary">
                    <div class="panel-heading">Escolha um opção</div>
                    <div class="panel-body text-center">
                        <p><a class="btn btn-primary btn-lg" href="#" title="#">Ver no Browser</a></p>
                        <p><a class="btn btn-primary btn-lg" href="#" title="#">Download</a></p>
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
                    <form class="form-inline">
                        <div class="form-group">
                            <div class="input-group">
                            <div class="input-group-addon">Anuidade inicial</div>
                            <input type="text" class="form-control" id="exampleInputAmount" placeholder="Exemplo 2019">
                            </div>
                        </div>

                        <div style="margin-top: 20px;" class="form-group">
                           <div class="input-group">
                           <div class="input-group-addon">Anuidade Final&nbsp;</div>
                           <input type="text" class="form-control" id="exampleInputAmount" placeholder="Exemplo 2020">
                           </div>
                       </div>
                       <hr>
                        <button  type="submit" class="btn btn-primary">Gerar PDF</button>
                    </form>
                    </div>
                </div>
            </div>
            
        <div class="back">
                <div class="panel panel-primary">
                    <div class="panel-heading">Escolha um opção</div>
                    <div class="panel-body text-center">
                        <p><a class="btn btn-primary btn-lg" href="#" title="#">Ver no Browser</a></p>
                        <p><a class="btn btn-primary btn-lg" href="#" title="#">Download</a></p>
                    </div>
                </div>
            </div>
      </div>
    </div>
    
</div>
<!-- Card 2 -->   
</div>

<script>
$(document).ready(function(){ //loads script after the page is loaded
  $('.').click(function(){ // When the element card-container is click it triggers the function
  	$(this).toggleClass("flipped"); // Finds the element and toggles the class called flipped to let you know the card is currently flipped or active
    	$('.card-container .flipped').toggle("flipper"); // If the card-container element also contains the class flipped it will toggle the flip
  });
});
</script>
@endsection
@endsection