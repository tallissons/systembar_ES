
<html lang="pt-br"><!-- SITE FICAR EM PORTUGUES-->

<head>
    <meta charset="utf-8"/>
    <title> REGISTRAR</title>
    <link rel="stylesheet" href="css/style_login.css">

    <style>
    *{
        margin: 0px;
        padding: 0px;
    }
    body{

        background-image: url("login1.jpg"); /* INSERINDO UMA IMAGEM */
        /*background-position: 50% 70%;  COLOCANDO A IMAGEM MAIS PRO MEIO */
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
    </style>
</head>

<body style="background-color:red">
    <div class="formulario">
        <form action="{{route('register')}}" autocomplete="off" method="POST">  <!-- CRIANDO UM FORMULARIO --> 
            <H1>CADASTRAR</H1>
            @csrf
            <input required type ="text"  name ="nome"placeholder="Nome Completo" maxlength="35">
            <input type ="text" name ="telefone"placeholder="Telefone"maxlength="15">
            <input required type ="email" name ="email"placeholder="Email"maxlength="40">
            <input required type ="password" name ="password" placeholder="Senha (no minimo 4 caracteres)" maxlength="15" minlength="4">   <!-- CRIANDO CAMPO PARA CADA QUEDITO , O PLACEHOLDER É PARA COLOCAR O NOME DENTRO DO CAMPO  --> 
            <input required type ="password" name ="confsenha" placeholder=" Confirmar Senha"maxlength="15">
            @foreach($errors->get('message') as $message)
                <h5 style="color:yellow; text-align:center">{{$message}}</h5>
            @endforeach
            <input type="submit" value="CADASTRAR">
        </form>
        <a href="{{route('login')}}">JÁ SOU CADASTRADO! FAZER LOGIN</a>
    </div>
</body>

</html>