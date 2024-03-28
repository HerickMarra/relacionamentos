<link rel="stylesheet" href="{{ asset("components/medidor/medidor.css?v=$version") }}">

<div  class="x-medidor-base">
    <div class="x-medidor-cicle">
            <div  class="x-medidor-medidores">
                <p class="x-medidor-medidores-title">Relacionamento</p>
                <p class="x-medidor-medidores-var" style="margin-top: 5px">90%</p>
                <button class="x-medidor-medidores-act clearBtn" >Adicionar Emoção</button>
            </div>

            <div style="display: none" class="x-medidor-medidores">
                <p class="x-medidor-medidores-title">Mestruação</p>
                <p class="x-medidor-medidores-var" style="margin-top: 5px">25/04</p>
                <button class="x-medidor-medidores-act clearBtn" >Calendario menstrual</button>
            </div>

    </div>
</div>

<script src="{{ asset('components/medidor/medidor.js') }}"></script>
