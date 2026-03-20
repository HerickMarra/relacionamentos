<link rel="stylesheet" href="{{ asset("components/analiseparceiro/analiseparceiro.css?v=$version") }}">
<link rel="stylesheet" href="{{ asset("css/love-languages/cute.css?v=$version") }}">

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
                
                {{-- Love Language info removed from here - moved to a separate card --}}

                <a href="/emotion/{{$item->id}}"><button  class="clearBtn btnAct X-AnaliseParceiro-Parceiro-Analises-btn">Avaliações</button></a>
                @if (auth()->user()->id == $item->id)
                    <a style="margin-left: 10px;" href="#"><button  class="clearBtn btnAct X-AnaliseParceiro-Editar-Perfil-btn">Editar Perfil</button></a>
                @endif
            </div>
        </div>
    @endforeach

</div>
