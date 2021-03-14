

<html lang="pt-br"><!-- SITE FICAR EM PORTUGUES-->

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title> LOGIN  </title>
    <link rel="stylesheet" href="css/style_administrador.css">
    
    <style>
    *{
	margin: 0px;
	padding: 0px;
}
body{
	background-image: url("login1.jpg"); /* INSERINDO UMA IMAGEM */
	background-position: 60% 70%;  COLOCANDO A IMAGEM MAIS PRO MEIO */
	color: white;
	font-family: arial;

}

input{/* FORMATANDO O CSS DOS INPUT*/

	display: block; /* PARA UM CAPO FICAR EMBAIXO DO OUTRO*/
	height: 55px;
	width: 400px;
	margin: 10px;/* DISTANCIA ENTRE OS DOIS INPUT*/
	border-radius: 30px; /* BORDAR ARREDONDADA*/
	border: 1px solid black;
	font-size: 16px; /* FONTE DA LETRA DO CAMPO*/
	padding: 10px 20px;
	background-color: rgba(255,255,255,0.01); /*COLOCAR OS CAMPOS EM TRASPARENTE */
	color: white;
	outline: none;/* SEM FICAR O CONTORNO NOS CAMPOS*/
}
.formulario{
	/*background-color: red;*/
	width: 420px;
	height: 420px;
	margin: 120px auto 0px auto;
}
.formulario h1{
	text-align: center;/* ALIANDO NO CENTRO */
	padding: 20px; 
}
.formulario a{
	color: white; /* COR DOS LINKS*/
	text-decoration: none; 
	text-align: center;/* CENTRALIZAR O LINK*/
	display: block;/* CENTRALIZAR O LINK*/
}
a:hover{
	text-decoration: underline;/* QUANDO PASSAR POR CIMA DO LINK ELE APARECER */
}

input[type=submit]{ /* COLOCAR COR NO BOTÃO DE ACESSAR*/
	background-color: #3480C1;
	border: none;
	cursor: pointer; /* QUANDO PASSAR PELO BOTÃO DE ACESSAR APARECER A MAOZINHA */
}

::-webkit-input-placeholder {/* ALTERANDO A COR DO PLACEHOLDER*/
   color: #FFF;
}

:-moz-placeholder { /* Firefox 18- */
   color: #FFF;  
}

::-moz-placeholder {  /* Firefox 19+ */
   color: #FFF;  
}

:-ms-input-placeholder {  
   color: #FFF;  
}

div#msg-sucesso{
	width: 420px;
	margin: 10px auto;
	padding: 10px;
	background-color: rgb(50,205,50,.3);
	border: 1px solid rgb(34, 139,34);

}

div.msg-erro{

	width: 420px;
	margin: 10px auto;
	padding: 10px;
	background-color: rgb(250,128,114, .3);
	border: 1px solid rgb(165,42,42);
}
.h1{
	color: white;
	height: 90px;
}


    </style>
    

 </head>

 <body style="background-color:red">
     
     
     <div class="formulario">
         <form action="{{route('auth')}}" autocomplete="off" method="POST">  <!-- CRIANDO UM FORMULARIO --> 
		 	@csrf
             <div class="h1">
             <H1>SystemBar</H1>
             </div>

             <input required type ="email" placeholder="E-mail"maxlength="40" name ="email">   <!-- CRIANDO CAMPO PARA CADA QUEDITO , O PLACEHOLDER É PARA COLOCAR O NOME DENTRO DO CAMPO  --> 
             <input required type ="password" placeholder="Senha (no minimo 4 caracteres)" maxlength="15" minlength="4" name ="password">
             @foreach($errors->get('message') as $message)
                <h5 style="color:yellow; text-align:center">{{$message}}</h5>
            @endforeach
             <input type="submit" value="ACESSAR">
         </form>
         <a href="{{route('formRegister')}}">AINDA NÃO É INSCRITO? CADASTRE-SE</a>
     </div>


     


     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </body>

</html>
