<link rel="stylesheet" href="{{ asset("components/notificacao/Notificacao.css?=$version") }}">

<div class="x-notificacao">
    <div onclick="x_notificacao_abrir_aba()" class="notfy">
        <i class="bi bi-bell"></i>
            <div class="countNotfy">{{$countN}}</div>
    </div>
</div>


<div style="display: none" class="x-notificacao-aba" id="x-notificacao-aba">
    <div class="x-notificacao-aba-actions">
        <i onclick="x_notificacao_fechar_aba()" class="bi bi-arrow-left"></i> <p>Notificações</p>
    </div>

    <div class="x-notificacao-aba-notify-area" id="x-notificacao-aba-notify-area">

    </div>
</div>

<div id="x-notificacao-modalDetalhes" style="display: none" class="modal">
    <div class="modalContainer x-notificacao-modalDetalhes-container">
        <div class="backgroudImage x-notificacao-modalDetalhes-image"></div>
        <p class="x-notificacao-modalDetalhes-title"></p>
        <p class="x-notificacao-modalDetalhes-desc"></p>
        <button class="btnAct x-notificacao-modalDetalhes-act" onclick="x_notificacao_exitModalDetalhes()">Voltar</button>
    </div>
</div>

<script>
    // Url de atualização de notificações
    let X_notificacao_URLAtualizar = '{{route('get.notification.count')}}';
    let X_notificacao_URLGet = '{{route('get.notification.itens')}}';
    let X_notificacao_URLGetDetails = '{{route('get.notification.item')}}';
</script>
<script src="{{ asset('components/notificacao/Notificacao.js') }}"></script>
