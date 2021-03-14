<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Tallisson Souza">

        <title>@yield('title')</title>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="https://customts.netlify.app/css/cssts.css"  media="screen,projection"/>

        @stack('style')

    </head>
    <body>

    <header class="row">
            <nav class="deep-orange">
                <div class="nav-wrapper container">
                    <a href="/" class="brand-logo">SystemBar</a>
                    <a href="#" data-activates="mobile" class="button-collapse"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">

                        @if(Auth::guest())
                            <li><a href="/" >Cardápio</a></li>
                            <li><a href="{{route('frmreservar')}}" >Reservar Mesa</a></li>
                            <li><a href="{{route('login')}}" >Login</a></li>
                        @else
                            @if(Auth::user()->permissao == 1)
                                <li><a href="{{route('portal.home')}}">Portal</a></li>
                            @endif

                            <li><a href="/">Cardápio</a></li>
                            <li><a href="{{route('frmreservar')}}" >Reservar Mesa</a></li>
                            <li><a href="{{route('carrinho')}}">Carrinho</a></li>
                            <li><a href="{{route('pedido.historico')}}">Histórico</a></li>
                            <li><a href="#!" class="dropdown-button" data-activates="dropdown-cliente" data-beloworigin="true" >{{Auth::user()->nome}}<i class="material-icons right">arrow_drop_down</i></a></li>
                        @endif
                    </ul>

                    <ul class="side-nav" id="mobile">
                        <li>
                            <div class="user-view">
                                <div class="background">
                                    <img src="http://archives.materializecss.com/0.100.2/images/office.jpg">
                                </div>

                                @if(auth()->check())
                                    <a href="#!user"><img class="circle" src="https://thumbs.dreamstime.com/b/%C3%ADcone-preto-cont%C3%ADnuo-do-avatar-perfil-de-usu%C3%A1rio-134114292.jpg"></a>
                                    <a href="#!name"><span class="white-text name">{{auth()->guard()->user()->nome}}</span></a>
                                    <a href="#!email"><span class="white-text email">{{auth()->guard()->user()->email}}</span></a>
                                @else
                                    <span class="center">System Bar</span>
                                @endif
                            </div>
                        </li>
                        @if(Auth::guest())
                            <li><a href="/">Cardápio</a></li>
                            <li><a href="{{route('frmreservar')}}">Reservar Mesa</a></li>
                            <li><a href="{{route('login')}}">Login</a></li>
                        @else
                            @if(Auth::user()->permissao == 1)
                                <li><a href="{{route('portal.home')}}">Portal</a></li>
                            @endif

                            <li><a href="/">Cardápio</a></li>
                            <li><a href="{{route('frmreservar')}}" >Reservar Mesa</a></li>
                            <li><a href="{{route('carrinho')}}">Carrinho</a></li>
                            <li><a href="{{route('pedido.historico')}}">Histórico</a></li>
                            <li><a href="{{route('logout')}}">Sair</a></li>
                        @endif
                    </ul>
                </div>
            </nav>

            <!--Menu dropdown Cliente-->
            <ul class="dropdown-content" id="dropdown-cliente">
                <li><a class="center" href="{{route('logout')}}">Sair</a></li>
            </ul>
            <!--Fim dropdown -->
    </header>

        <main class="container row">
