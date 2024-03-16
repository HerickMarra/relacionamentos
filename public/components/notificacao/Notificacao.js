

let x_notificacao_aba = null;//Elemnto da aba de notificação


document.addEventListener('DOMContentLoaded', function() {
    setInterval(atualizarNot, 6000);
    x_notificacao_aba = $('#x-notificacao-aba');
    x_notificacao_aba.appendTo('.areaMobile');
});


function atualizarNot(){
        $.ajax({
            type: 'get',
            url: X_notificacao_URLAtualizar, // URL para onde os dados serão enviados
            data: {
            }, // Dados do formulário a serem enviados
            dataType: 'json', // Tipo de dados esperado como resposta
            encode: true
        })
        .done(function(data) {
           $('.countNotfy').text(data.count);
        })
        .fail(function(data) {

        });
}



function x_notificacao_abrir_aba(){
    x_notificacao_aba.fadeIn();
}

function x_notificacao_fechar_aba(){
    x_notificacao_aba.fadeOut();
}
