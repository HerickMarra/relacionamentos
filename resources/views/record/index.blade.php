<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Galeria</title>

    @include('painel.importsHeader')

</head>
<body class="flexCenter-c">
    <div class="areaMobile">
        <x-Notificacao/>

        <x-record.add-image/>
        <x-MarcadoresFixo/>
        <x-NavBar/>
    </div>

@include('painel.importsScript')
</body>
</html>
