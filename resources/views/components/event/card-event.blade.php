

<div class="x-cardevent">
    <div class="x-cardevent-img" style="background-image: url({{asset($event->picture)}}"></div>

    <div class="x-cardevent-desc">
        <p class="x-cardevent-desc-T">{{$event->title}}</p>
        <p style="font-size:10px;" >{{$event->desc}}</p>
        <p class="x-cardventodesc-D">{{date('d/m', strtotime($event->date))}}</p>
        @if (in_array($event->act, ['link']))
            <div class="x-cardevent-link">
                <a href="{{$event->act_link}}">
                    <button class="clearBtn btnAct">Ver Mais</button>
                </a>
            </div>
        @endif

    </div>


</div>
