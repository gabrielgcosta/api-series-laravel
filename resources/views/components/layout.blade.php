<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - Controle de Séries</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div class="container-fluid">
        <a href="{{route('series.index')}}" class="navbar-brand">Home</a>
        
        {{-- Esse @auth verifica se existe um usuário logado, e caso tenha realiza
             o seu conteudo --}}
        @auth   
        <a href="{{route('logout')}}">Sair</a>
        @endauth
        
        {{-- @guest verifica se não tem usuário logado, sendo um convidado --}}
        @guest
        <a href="{{route('login')}}">Entrar</a>
        @endguest
    </div>
</nav> 
<div class="container">
    <h1>{{ $title }}</h1>

    {{-- verifica se mensagemSucesso existe, caso exista mostra na tela --}}
    @isset($mensagemSucesso)
    <div class="alert alert-success">
        {{$mensagemSucesso}}
    </div>
    @endisset

    {{-- Ao falhar na validação da request, o laravel cria mensagens de erros na session
         que podem ser acessadas atraves dessa variavel $errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ $slot }}
</div>
</body>
</html>
