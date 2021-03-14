<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Tallisson Souza">

        <title>@yield('title')</title>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="https://customts.netlify.app/css/tscss.css"  media="screen,projection"/>

        <style>

        </style>

    </head>
    <body>

    <header class="row">

        <div class="navbar-fixed">
        <nav class="red">
            <div class="nav-wrapper container-main">
            <a href="{{route('portal.home')}}" class="brand-logo">SystemBar</a>
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
            </div>
        </nav>
        </div>

        <div id="ajax_nav">
        </div>

    </header>

        <main class="container-main row">

