<link rel="stylesheet" href="{{ asset('components/notificacao/Notificacao.css') }}">

<div class="x-notificacao">
    <div class="notfy">
        <i class="bi bi-bell"></i>
        @if ($countN)
            <div class="countNotfy">{{$countN}}</div>
        @endif
    </div>
</div>


<script>
    let X_notificacao_URLAtualizar = '{{route('get.notification.count')}}';
</script>
<script src="{{ asset('components/notificacao/Notificacao.js') }}"></script>
