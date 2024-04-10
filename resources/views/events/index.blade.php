<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eventos</title>

    @include('painel.importsHeader')

    <link rel="stylesheet" href="/components/events/cardevents/cardevents.css">

</head>
<body class="flexCenter-c">
    <div class="areaMobile">
        <x-Notificacao/>
        <div style="height: 60px"></div>
        @foreach ($events as $event)
            <x-event.card-event :event="$event"  />

        @endforeach

        <x-MarcadoresFixo/>
        <x-NavBar/>
    </div>

@include('painel.importsScript')
</body>
</html>
