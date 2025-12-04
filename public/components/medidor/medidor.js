let x_medidor_qntItens = 0, x_medidor_atual = 0, x_medidor_element = null;

window.onload = function() {
    x_medidor_element = $('.x-medidor-medidores');
    x_Medidor_qntItens = x_medidor_element.length;
    setInterval(()=>{
        x_medidor_atual++;
        if(x_medidor_atual>= 2){
            x_medidor_atual = 0;
        }
        x_medidor_element.fadeOut();
        x_medidor_element.eq(x_medidor_atual).fadeIn();
    },30000);
};