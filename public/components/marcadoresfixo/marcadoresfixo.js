
let X_MarcadorFixo_emotion = '';
function MarcadoresFixoAbrirModal(cor,emotion){
    X_MarcadorFixo_emotion = emotion;
    MarcadoresFixoSetMedidor(5)
    $('.x-MarcadoresFixo-i').hide();
    $(`.x-MarcadoresFixo-i-${cor}`).show();
    $('.x-MarcadoresFixo-Text').removeClass(`x-MarcadoresFixo-Green-p`);
    $('.x-MarcadoresFixo-Text').removeClass(`x-MarcadoresFixo-Danger-p`);
    $('.x-MarcadoresFixo-Text').removeClass(`x-MarcadoresFixo-Alert-p`);
    $('.x-MarcadoresFixo-Text').addClass(`x-MarcadoresFixo-${cor}-p`);

    $('.x-MarcadoresFixo-Submit').removeClass(`x-MarcadoresFixo-Green`);
    $('.x-MarcadoresFixo-Submit').removeClass(`x-MarcadoresFixo-Danger`);
    $('.x-MarcadoresFixo-Submit').removeClass(`x-MarcadoresFixo-Alert`);
    $('.x-MarcadoresFixo-Submit').addClass(`x-MarcadoresFixo-${cor}`);


    $('.x-MarcadoresFixo-Text').addClass(`x-MarcadoresFixo-${cor}-p`);
    $('.x-MarcadoresFixo-Modal').fadeIn();

    $('#x-MarcadoresFixo-Desc-Input').val('')
}

function MarcadoresFixoExitModal(){
    $('.x-MarcadoresFixo-Modal').fadeOut();
}


let x_MarcadoresFixo_URL_create = "/indicators/create";
function MarcadoresFixoSave(_token){
    $.ajax({
        type: 'post',
        url: x_MarcadoresFixo_URL_create, // URL para onde os dados serão enviados
        data: {
            _token : _token,
            emotion : {
                description : $('#x-MarcadoresFixo-Desc-Input').val(),
                level: medidorLevel,
                visible: $('#x-MarcadoresFixo-Desc-Visivel-input').is(':checked'),
                emotion: X_MarcadorFixo_emotion
            }
        }, // Dados do formulário a serem enviados
        dataType: 'json', // Tipo de dados esperado como resposta
        encode: true
    })
    .done(function(data) {
        MarcadoresFixoExitModal();
    })
    .fail(function(data) {

    });
}

let medidorLevel = 5;
function MarcadoresFixoSetMedidor(medidor){
    $('.x-MarcadoresFixo-Contador').removeClass('x-MarcadoresFixo-Contador-Active');
    $(`.MFC${medidor}`).addClass('x-MarcadoresFixo-Contador-Active');
    medidorLevel = medidor;
    console.log(medidorLevel);
}


