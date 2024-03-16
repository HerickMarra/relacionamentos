<link rel="stylesheet" href="{{ asset('components/notificacao/Notificacao.css') }}">

<div class="x-notificacao">
    <div onclick="x_notificacao_abrir_aba()" class="notfy">
        <i class="bi bi-bell"></i>
        @if ($countN)
            <div class="countNotfy">{{$countN}}</div>
        @endif
    </div>
</div>


<div style="display: none" class="x-notificacao-aba" id="x-notificacao-aba">
    <div class="x-notificacao-aba-actions">
        <i onclick="x_notificacao_fechar_aba()" class="bi bi-arrow-left"></i> <p>Notificações</p>
    </div>
</div>

<script>
    // Url de atualização de notificações
    let X_notificacao_URLAtualizar = '{{route('get.notification.count')}}';
</script>
<script src="{{ asset('components/notificacao/Notificacao.js') }}"></script>
