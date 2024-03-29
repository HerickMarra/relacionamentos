let X_addimage_Get = '/record';
let X_addimage_Create = '/record/create';
let X_addimage_pageAtual = 1;
function X_addimage_getImages(page = 1){
    X_addimage_pesquisando = true;
    $.ajax({
        type: 'post',
        url: X_addimage_Get, // URL para onde os dados serão enviados
        data: {
            _token: X_addimage_token,
            page: page,
        }, // Dados do formulário a serem enviados
        dataType: 'json', // Tipo de dados esperado como resposta
        encode: true
    })
    .done(function(data) {
        ;
        if(data.data.length > 0){
            X_addimage_addImage(data.data);
            X_addimage_pesquisando = false;
        }

    })
    .fail(function(data) {

    });
}

function X_addimage_fimRolagem(){
    X_addimage_pageAtual++;
    X_addimage_getImages(X_addimage_pageAtual);
}

window.onload = function() {
    X_addimage_getImages(1);
};

let X_addimage_pesquisando = false;
function chegouNoFinal() {
    // Obtém a altura total da página
    const alturaTotal = document.body.scrollHeight;

    // Obtém a altura da parte visível da página
    const alturaVisivel = window.innerHeight;

    // Obtém a posição vertical do scroll
    const scrollTop = window.scrollY;

    // Se a soma da altura visível e da posição vertical do scroll for igual à altura total, significa que o usuário chegou no final da página
    if (alturaVisivel + scrollTop > alturaTotal - 100 & !X_addimage_pesquisando) {
      // Executa a função desejada
      X_addimage_fimRolagem();
    }
  }


  window.addEventListener("scroll", chegouNoFinal);



  function X_addimage_addImage(data){
        data.forEach(element => {
            let div = $('<div>').addClass('x-addimage-image').appendTo('#x-addimage-images');
            $('<img>').appendTo(div).attr('src', element.picture);
            $('<div>').addClass('x-addimage-image-bio').appendTo(div);
        });
  }

  function x_addimage_hideModal(){
    $('.x-addimage-form').fadeOut();
  }

  function x_addimage_showModal(){
    $('.x-addimage-form').fadeIn();
  }

  function x_addimage_reset(){
    $("html, body").scrollTop(0);
    $('#x-addimage-images').html('');
    X_addimage_pageAtual = 1;
    X_addimage_getImages(1);
  }


  function x_addimage_adicionar(){
    var fileInput = document.getElementById('x-addimage-inoput-image');
    var file = fileInput.files[0];

    if(file) {
        var reader = new FileReader();
        reader.onload = function(event) {
            var base64String = event.target.result;
            // var imagePreview = document.getElementById('imagePreview');
            // imagePreview.innerHTML = '<img style="width: 100px" src="' + base64String + '" />';
            $.ajax({
                type: 'post',
                url: X_addimage_Create, // URL para onde os dados serão enviados
                data: {
                    _token: X_addimage_token,
                    image: base64String,
                }, // Dados do formulário a serem enviados
                dataType: 'json', // Tipo de dados esperado como resposta
                encode: true
            })
            .done(function(data) {
                x_addimage_reset();
                x_addimage_hideModal()
            })
            .fail(function(data) {

            });
        };
        reader.readAsDataURL(file);
    } else {
        alert('Por favor, selecione um arquivo de imagem.');
    }
  }
