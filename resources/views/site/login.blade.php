
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css?family=Concert+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Noto+Sans+TC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton|Modak|Noto+Sans+TC" rel="stylesheet">
    <?php

?>

<style>
body{
    width: 100%;
    height: 100%;
    background-image: url('imagens/pontee.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: scroll;  
}

*{
    margin: 0%;
    padding: 0px;
}

h1{
    color:white;
    border-bottom-color: aliceblue;
    text-align: center;
    padding: 10px;
    font-family: 'Concert One', cursive;
}
h3{
    font-size: 11pt;
    color: white;
    margin-top: 30px;

}
a{
    text-decoration: none;
    color:rgba(255,255, 255, 0.4);
    display: block;
    text-align: center;
    font-family: 'Noto Sans TC', sans-serif;
}
a:hover{
    text-decoration: underline;
}

button#botaoLogin{
    font-family: 'Noto Sans TC', sans-serif;
    width: 100%;
    margin-top: 10px;
}

img{
    width: 210px;
    height: 60px;
    margin: 5px;

}
div#corpo-imagem{
    margin: 0px;
   
}
div#corpo-login{
    width: 420px;
    margin: 140px auto 0px auto;
    background-color: #000000;
    opacity: 0.8;
    padding: 50px;
    border-radius: 10px;
    align-items: center;
}
div#botaoregistrar{
    display: flex;
    margin-top: 20px;
}
div#cdtusuario{
    flex-direction: row;
    margin: 5px;
    padding: 0px;
}
button#btnAbrirModal{
    font-size: 13px;
}
</style>
</head>
<body>
<div id="corpo-imagem">
        <img src="imagens/CREA-DF2.png"/>
    </div>
<div id = "corpo-login" class="container-fluid">
    <h1>LOGIN</H1>
<!--Formulário Login-->
        <form action="{{route('home')}}" method="POST">
        @csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">#</span>
                </div>
                    <input id='usuario' type="text" name="usuario" class="form-control" placeholder="Usuário" aria-label="Usuário" aria-describedby="basic-addon1">
                </div>

                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">#</span>
                </div>
                <input id='senha' type="password" name="senha" class="form-control" placeholder="Senha" aria-label="Usuário" aria-describedby="basic-addon1">
                </div>
                 <button id='botaoLogin' class="btn btn-outline-primary" type = "submit" name = "enviar" value = "Entrar">Entrar</button>
        </form>  
</div>  


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>