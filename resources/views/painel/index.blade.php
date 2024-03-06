<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel</title>

    @include('painel.importsHeader')

</head>
<body>
    <div class="areaMobile">
        <x-Notificacao/>
        <x-medidor/>
        <x-ButtonsPainel/>
        <x-MarcadoresFixo/>
    </div>


    @include('painel.importsScript')
</body>
</html>

