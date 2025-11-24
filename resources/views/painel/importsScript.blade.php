<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




<script>
    // QUANDO A PÁGINA COMEÇA A SAIR (antes de carregar a próxima)
    window.addEventListener('beforeunload', function() {
        $(".load1").fadeIn(200); // ou fadeIn
    });

    // QUANDO A PÁGINA ACABOU DE CARREGAR
    $(window).on("load", function () {
        $(".load1").fadeOut(200);
    });

    window.addEventListener("pageshow", function (event) {
        // Se a página veio do bfcache, esconda o loader
        if (event.persisted) {
            $(".load1").fadeOut(200); // ou fadeOut
        } else {
            // Página carregou normalmente
            $(".load1").fadeOut(200);
        }
    });
</script>

