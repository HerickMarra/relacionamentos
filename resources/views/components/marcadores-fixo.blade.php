<link rel="stylesheet" href="{{ asset('components/marcadoresfixo/marcadoresfixo.css') }}">

<div class="x-MarcadoresFixo">
    <div class="x-MarcadoresFixo-areaBtn">

        <div onclick="abrirModal('Green','')" class="x-MarcadoresFixo-areaBtn-btn ">
            <i class="bi bi-emoji-heart-eyes-fill"></i>
        </div>

        <div onclick="abrirModal('Danger','')" class="x-MarcadoresFixo-areaBtn-btn">
            <i class="bi bi-exclamation-octagon-fill"></i>
        </div>

        <div onclick="abrirModal('Alert','')" class="x-MarcadoresFixo-areaBtn-btn">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>

    </div>
</div>




<div style="display: none;" class="x-MarcadoresFixo-Modal">

    <div class="x-MarcadoresFixo-Modal-Container">
        <div class="modalExit">
            <button onclick="exitModal()">X</button>
        </div>

        <div class="x-MarcadoresFixo-Modal-Container-Indicador ">
            <div class="x-MarcadoresFixo-Modal-Container-Indicador-Icon x-MarcadoresFixo-Alert x-MarcadoresFixo-i x-MarcadoresFixo-i-Alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </div>

             <div class="x-MarcadoresFixo-Modal-Container-Indicador-Icon x-MarcadoresFixo-Danger x-MarcadoresFixo-i x-MarcadoresFixo-i-Danger">
                <i class="bi bi-exclamation-octagon-fill"></i>
            </div>

            <div class="x-MarcadoresFixo-Modal-Container-Indicador-Icon x-MarcadoresFixo-Green x-MarcadoresFixo-i x-MarcadoresFixo-i-Green">
                <i class="bi bi-emoji-heart-eyes-fill"></i>
            </div>
        </div>

        <p class="x-MarcadoresFixo-Modal-Container-Desc x-MarcadoresFixo-Text">Atribua uma pontuação de 0 a 10, com base em sua avaliação geral</p>

        <div class="x-MarcadoresFixo-Modal-Container-Indicador-Contadores">
            <div class="x-MarcadoresFixo-Contador">1</div>
            <div class="x-MarcadoresFixo-Contador">2</div>
            <div class="x-MarcadoresFixo-Contador">3</div>
            <div class="x-MarcadoresFixo-Contador">4</div>
            <div class="x-MarcadoresFixo-Contador">5</div>
        </div>

        <div class="x-MarcadoresFixo-Modal-Container-Indicador-Contadores">
            <div class="x-MarcadoresFixo-Contador">6</div>
            <div class="x-MarcadoresFixo-Contador">7</div>
            <div class="x-MarcadoresFixo-Contador">8</div>
            <div class="x-MarcadoresFixo-Contador">9</div>
            <div class="x-MarcadoresFixo-Contador">10</div>
        </div>

        <div class="x-MarcadoresFixo-Modal-Container-Desc-Inpt">
            <label for="" class="x-MarcadoresFixo-Text">Adicionar descrição</label>
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>

        <div class="x-MarcadoresFixo-Modal-Container-Send">
            <button class="x-MarcadoresFixo-Green">ENVIAR</button>
        </div>

    </div>
</div>


<script src="{{ asset('components/marcadoresfixo/marcadoresfixo.js') }}"></script>
