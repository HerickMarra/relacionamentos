<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel</title>

    @include('painel.importsHeader')
    <link rel="stylesheet" href="{{ asset("css/painel/index.css?v=$version") }}">

</head>
<body class="flexCenter-c">
    <div class="areaMobile">
        <x-StatusOnline/>
        <x-medidor/>
        {{-- <x-ButtonsPainel/> --}}

        <x-Eventos/>

        <x-AnalisesParceiro/>
        <x-MarcadoresFixo/>
        <x-NavBar/>
        <x-Notificacao/>
    </div>


    @include('painel.importsScript')
</body>
</html>

