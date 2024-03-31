<link rel="stylesheet" href="{{ asset("components/eventos/eventos.css?v=$version") }}">

@if (count($events))

<div class="x-eventos">
    <p class="x-eventos-title">Proximos Eventos</p>
    @foreach ($events as $event)
    <div class="x-evento">
        <div class="x-evento-img" style="background-image: url({{asset($event->picture)}}"></div>

        <div class="x-evento-desc">
            <p class="x-evento-desc-T">{{$event->title}}</p>
            <p class="x-evento-desc-D">{{date('d/m', strtotime($event->date))}}</p>
            @if (in_array($event->act, ['link']))
                <div class="x-evento-link">
                    <a href="{{$event->act_link}}">
                        <button class="clearBtn btnAct">Ver Mais</button>
                    </a>
                </div>
            @endif

        </div>


    </div>
    @endforeach

    <a href="" class="baseText x-eventos-vermais">Ver todos os eventos</a>

</div>
@endif
