

document.addEventListener('DOMContentLoaded', function() {
    setInterval(atualizarNot, 6000)
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
