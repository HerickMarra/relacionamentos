<link rel="stylesheet" href="{{ asset("components/analiseparceiro/analiseparceiro.css?v=$version") }}">

<p class="globalTitle">Visão geral</p>
<div class="X-AnaliseParceiro">
    @foreach ($users_Parceiros as $item)
        <div class="X-AnaliseParceiro-Parceiro">
            <div class="X-AnaliseParceiro-Parceiro-Perfil">
                <div style="background-image: url({{$item->profile_picture}})" class="X-AnaliseParceiro-Parceiro-Perfil-Picture"></div>
            </div>

            <div class="X-AnaliseParceiro-Parceiro-Analises">
                <p class="X-AnaliseParceiro-Parceiro-Analises-AV">Avaliações: {{count($item->emotions)}}</p>
                <p class="X-AnaliseParceiro-Parceiro-Analises-LL">{{lastLogin($item->last_login)}}</p>
                <a href="/emotion/{{$item->id}}"><button  class="clearBtn btnAct X-AnaliseParceiro-Parceiro-Analises-btn">Avaliações</button></a>
                <a style="margin-left: 10px;" href="#"><button  class="clearBtn btnAct X-AnaliseParceiro-Editar-Perfil-btn">Editar Perfil</button></a>
            </div>
        </div>
    @endforeach

</div>
