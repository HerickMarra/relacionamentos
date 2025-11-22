<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/base.css?v=$version') }}">
    <link rel="stylesheet" href="{{ asset('css/auth/login.css?v=$version') }}">

    {{-- Fonte --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    {{-- Fonte --}}


    <title>Login</title>
</head>
<body>
    {{-- Area de escolha de logins --}}
    <div  class="area areaLogin">
        @foreach ($users as $user)
            <div onclick="selectLogin(this, {{$user->id}})" class="userLogin">
                <div style="background-image: url({{asset($user->profile_picture)}})" class="profile">
                </div>
                <p class="name">{{$user->name}}</p>
            </div>
        @endforeach
    </div>
    {{-- Area de escolha de logins --}}


    <h1>BRASIL</h1>
    {{-- Area de autenticação --}}
    <div  style="display: none"  class="area areaLoginAuth">
        <div style="background-image: url({{asset("/img/anne.jpg")}})" class="profile" id="profileAuth">
        </div>
        <p  class="name" id="nameAuth"> -- </p>
        <form class="formAuth" action="" method="post">
            @csrf
            <input type="hidden" name="id" id="idAuth">
            <input placeholder="Senha" type="password" name="password" id="password" class="inputAuth">
            <button  type="submit" class="btnAuth">ENTRAR</button>
        </form>
    </div>
    {{-- Area de autenticação --}}

    {{-- Container Load --}}
    <div style="display: none"  class="area areaLoad">
        <div class="loader">
            <div></div>

            <div></div>
        </div>
    </div>
    {{-- Container Load --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        let idUserLogin = -1;
        function selectLogin(el, id){
            idUserLogin = id;
            el = $(el);
            $('#profileAuth').css('backgroundImage', el.find('.profile').css('backgroundImage'));
            $('#nameAuth').text(el.find('.name').text());
            $('#idAuth').val(id);
            $('.areaLogin').hide();
            $('.areaLoginAuth').show();
        }

        $('.formAuth').submit(function(event){
            event.preventDefault();
            $('.area').hide();
            $('.areaLoad').show();
            $.ajax({
                type: 'POST',
                url: '{{route('loginAuth')}}', // URL para onde os dados serão enviados
                data: {
                    _token: '{{csrf_token()}}',
                    user: {
                        id: idUserLogin,
                        password: $('#password').val()
                    }
                }, // Dados do formulário a serem enviados
                dataType: 'json', // Tipo de dados esperado como resposta
                encode: true
            })
            .done(function(data) {
                location.href = "/painel";
            })
            .fail(function(data) {
                $('#password').css({
                    'border' : '1px solid red'
                });
                $('.area').hide();
                $('.areaLoginAuth').show();
            });
        });
    </script>
</body>
</html>
