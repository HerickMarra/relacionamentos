<link rel="stylesheet" href="{{ asset('components/marcadoresfixo/marcadoresfixo.css?v=a') }}">

<div class="x-MarcadoresFixo">
    <div class="x-MarcadoresFixo-areaBtn">

        <div onclick="MarcadoresFixoAbrirModal('Green','happy')" class="x-MarcadoresFixo-areaBtn-btn ">
            <i class="bi bi-emoji-heart-eyes-fill"></i>
        </div>

        <div onclick="MarcadoresFixoAbrirModal('Danger','serious')" class="x-MarcadoresFixo-areaBtn-btn">
            <i class="bi bi-exclamation-octagon-fill"></i>
        </div>

        <div onclick="MarcadoresFixoAbrirModal('Alert','alert')" class="x-MarcadoresFixo-areaBtn-btn">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>

    </div>
</div>




<div style="display: none;" class="x-MarcadoresFixo-Modal">

    <div class="x-MarcadoresFixo-Modal-Container">
        <div class="modalExit">
            <button onclick="MarcadoresFixoExitModal()">X</button>
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
            <div class="x-MarcadoresFixo-Contador MFC1" onclick="MarcadoresFixoSetMedidor(1)">1</div>
            <div class="x-MarcadoresFixo-Contador MFC2" onclick="MarcadoresFixoSetMedidor(2)">2</div>
            <div class="x-MarcadoresFixo-Contador MFC3" onclick="MarcadoresFixoSetMedidor(3)">3</div>
            <div class="x-MarcadoresFixo-Contador MFC4" onclick="MarcadoresFixoSetMedidor(4)">4</div>
            <div class="x-MarcadoresFixo-Contador MFC5" onclick="MarcadoresFixoSetMedidor(5)">5</div>
        </div>

        <div class="x-MarcadoresFixo-Modal-Container-Indicador-Contadores">
            <div class="x-MarcadoresFixo-Contador MFC6" onclick="MarcadoresFixoSetMedidor(6)">6</div>
            <div class="x-MarcadoresFixo-Contador MFC7" onclick="MarcadoresFixoSetMedidor(7)">7</div>
            <div class="x-MarcadoresFixo-Contador MFC8" onclick="MarcadoresFixoSetMedidor(8)">8</div>
            <div class="x-MarcadoresFixo-Contador MFC9" onclick="MarcadoresFixoSetMedidor(9)">9</div>
            <div class="x-MarcadoresFixo-Contador MFC10" onclick="MarcadoresFixoSetMedidor(10)">10</div>
        </div>

        <div class="x-MarcadoresFixo-Modal-Container-Desc-Inpt">
            <label for="" class="x-MarcadoresFixo-Text">Adicionar descrição</label>
            <textarea name="x-MarcadoresFixo-Desc-Input" id="x-MarcadoresFixo-Desc-Input" cols="30" rows="10"></textarea>
        </div>

        <div class="x-MarcadoresFixo-Desc-Visivel">
            <label style="height: 10px;" class="checkbox-container">
                <input class="custom-checkbox" id="x-MarcadoresFixo-Desc-Visivel-input" checked="" type="checkbox">
                <span class="checkmark"></span>
            </label>
            <label class="x-MarcadoresFixo-Desc-Visivel-label" for="">Descrição visivel</label>
        </div>

        <div class="x-MarcadoresFixo-Modal-Container-Send">
            <button onclick="MarcadoresFixoSave('{{csrf_token()}}')" class="x-MarcadoresFixo-Submit x-MarcadoresFixo-Green">ENVIAR</button>
        </div>

    </div>
</div>


<script src="{{ asset('components/marcadoresfixo/marcadoresfixo.js') }}"></script>
