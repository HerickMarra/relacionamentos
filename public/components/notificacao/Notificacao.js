

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
    x_notificacao_class.clearNotify();
    x_notificacao_class.getNotificacoes()
}

function x_notificacao_fechar_aba(){
    x_notificacao_aba.fadeOut();
}





class Notificacao{
    constructor(options) {
        this.notificacoes = [];
        this.pag = 1;
    }

    clearNotify(){
        $('#x-notificacao-aba-notify-area').html('');
    }

    createNotifyElement(options){
        let not = $('<div>')
        .addClass('x-notificacao-aba-notify-area-not')
        .appendTo('#x-notificacao-aba-notify-area');

        $('<div>').addClass('x-notificacao-aba-notify-area-not-image')
        .appendTo(not).css({
            'backgroundImage' : `url('${options.image ?? ''}')`
        });

        if(options.desc.length > 34){
            options.desc = options.desc.substring(0, 34)+"..."
        }

        let titulo = $('<p>').text(options.titulo ?? ' -- ').addClass('x-notificacao-aba-notify-area-not-desc-titulo')
        let desc = $('<p>').text(options.desc ?? ' -- ').addClass('x-notificacao-aba-notify-area-not-desc-desc')
        let subDesc = $('<p>').text(options.subDesc ?? ' -- ').addClass('x-notificacao-aba-notify-area-not-desc-subDesc')

        $('<div>').addClass('x-notificacao-aba-notify-area-not-desc')
        .append(titulo)
        .append(desc)
        .append(subDesc)
        .appendTo(not);


        let icon = $('<i>').addClass(options.icon).css({
            'color' : options.colorIcon ?? '#fff'
        })

        $('<div>').addClass('x-notificacao-aba-notify-area-not-icon')
        .append(icon).appendTo(not);

        if(options.status == 'pendente'){
            $('<div>').addClass('x-notificacao-aba-notify-area-lida')
            .appendTo(not).append($('<i>').addClass('bi bi-exclamation-lg'));
        }

    }



    getNotificacoes(pag){

        $.ajax({
            type: 'get',
            url: X_notificacao_URLGet, // URL para onde os dados serão enviados
            data: {
                pag: this.pag
            }, // Dados do formulário a serem enviados
            dataType: 'json', // Tipo de dados esperado como resposta
            encode: true
        })
        .done((data) => {
            if(pag == 1){
                this.clearNotify();
            }
            data.forEach(element => {
                this.createNotifyElement({
                    colorIcon: element.color,
                    titulo: element.title,
                    desc: element.desc,
                    icon: element.icon,
                    subDesc: element.subdesc,
                    image: element.image,
                    status : element.status
                })
            });
        })
        .fail((data) => {

        });
    }

}


let x_notificacao_class = new Notificacao({});




