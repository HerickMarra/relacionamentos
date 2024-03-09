
function abrirModal(cor,icon){
    $('.x-MarcadoresFixo-i').hide();
    $(`.x-MarcadoresFixo-i-${cor}`).show();
    $('.x-MarcadoresFixo-Text').removeClass(`x-MarcadoresFixo-Green-p`);
    $('.x-MarcadoresFixo-Text').removeClass(`x-MarcadoresFixo-Danger-p`);
    $('.x-MarcadoresFixo-Text').removeClass(`x-MarcadoresFixo-Alert-p`);
    $('.x-MarcadoresFixo-Text').addClass(`x-MarcadoresFixo-${cor}-p`);
    $('.x-MarcadoresFixo-Modal').fadeIn();
}

function exitModal(){
    $('.x-MarcadoresFixo-Modal').fadeOut();

}
