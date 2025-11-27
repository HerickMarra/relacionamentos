@props(['usersGif'])
<div class="baseMoodGif"> 
    
    <h2 class="titulo">Como está se sentindo hoje? oi</h2>

    @foreach ($usersGif as $gif)
        <div class="containerGifUser">
            <img class="containerGifUser-imagePerfil" src="{{ $gif->profile_picture }}" alt="">
            @if (isset($gif->latestMoodGif->gif_url))
            <img class="gifUser" src="{{ $gif->latestMoodGif->gif_url }}" alt="">
            @else
                <p style="text-align: center; color: #fff; padding: 100px 0 0 0;">Sem emoção</p>
            @endif

            @if ($gif->id == auth()->user()->id)
                <button class="btn-abrir" onclick="openModal()">@if (isset($gif->latestMoodGif->gif_url)) Alterar Emoção @else Adicionar Emoção @endif </button>
            @else
            @endif
        </div>
        
        
    @endforeach

    <!-- Modal -->
    <div id="gifModal" class="modal">
        <div class="modal-content">
            <h3 class="modal-titulo">Selecione um GIF</h3>
            <div class="busca-container">
                <input type="text" id="search" placeholder="Buscar sentimento..." class="input-busca">
                <button class="btn-buscar" onclick="searchGif(true)">Buscar</button>
            </div>
            <div id="gifs" class="gifs-container"></div>
            <div id="loaderGif" class="load1" style=" display:none; justify-content: center; align-items: center;">
                <svg viewBox="25 25 50 50">
                    <circle r="20" cy="50" cx="50"></circle>
                </svg>
            </div>
            <button class="btn-fechar" onclick="closeModal()">✖</button>
        </div>
    </div>
</div>

<style>
.containerGifUser-imagePerfil{
    width: 50px;
    height: 50px;
    border-radius: 5px;
    filter: drop-shadow(1px 1px  10px rgba(255, 0, 0, 0.251));
    position: absolute;
    z-index: 2;
    top: 0;
    left: 0;
}

.baseMoodGif{
    margin-top: 50px;
}
.containerGifUser{
    width: 80%;
    margin: 15px auto;
    display: block;
    position: relative;
}

.containerGifUser .gifUser{
    display: block;
    margin: 0 auto;
    padding: 10px 0 0 0;
    border-radius: 10px;
    width: 100%;
    filter: var(--sombra);
    z-index: 1;
}


/* Component CSS */
.titulo {
    color: var(--text-color);
    margin-bottom: 15px;
    font-size: 15px;
    text-align: center;
    width: 80%;
    margin: 0 auto 20px auto;
}

.btn-abrir, .btn-buscar {
    background: var(--subBackground);
    color: var(--text-color);
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: var(--sombra);
    transition: transform 0.2s;
    margin: 20px auto 20px auto;
    display: block;
}

.btn-abrir:hover, .btn-buscar:hover {
    transform: scale(1.05);
}

.modal {
    display: none;
    position: fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background: rgba(0,0,0,0.7);
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.modal-content {
    background: var(--subBackground);
    padding: 20px;
    border-radius: 12px;
    width: 100%;
    max-width: 500px;
    max-height: 80%;
    min-height: 350px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: var(--sombra);
    position: relative;
}

.modal-titulo {
    color: var(--text-color);
    margin-bottom: 10px;
    text-align: center;
}

.busca-container {
    display: flex;
    gap: 5px;
    margin-bottom: 10px;
}

.input-busca {
    flex: 1;
    padding: 8px;
    border-radius: 6px;
    border: 1px solid var(--subBackground-s);
    background: var(--background);
    color: var(--text-color);
}

.gifs-container {
    flex: 1;
    overflow-y: auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 5px;
    padding-right: 5px; /* espaço para scrollbar */
}

.gifs-container img {
    width: 30%;
    min-width: 80px;
    border-radius: 8px;
    box-shadow: var(--sombra);
    cursor: pointer;
    transition: transform 0.2s;
}

.gifs-container img:hover {
    transform: scale(1.05);
}

.btn-fechar {
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent;
    color: var(--text-color);
    border: none;
    font-size: 20px;
    cursor: pointer;
}

/* RESPONSIVO */
@media (max-width: 768px) {
    .modal-content {
        max-width: 95%;
        padding: 15px;
    }

    .gifs-container img {
        width: 45%;
    }
}

@media (max-width: 480px) {
    .gifs-container img {
        width: 80%;
    }

    .busca-container {
        flex-direction: column;
    }

    .input-busca, .btn-buscar {
        width: 100%;
    }
}
</style>


<script>
    const apiKey = "{{ env('GIPHY_KEY') }}";
    let currentQuery = '';
    let offset = 0;
    let isLoading = false;
    let isUserSearch = false; // indica se a busca é do usuário

    // Palavras-chave genéricas para pré-carregar
    const defaultTags = ['felicidade', 'amor', 'tristeza', 'divertido', 'emoji'];
    let defaultTagIndex = 0; // controla qual tag está carregando

    function openModal() {
        document.getElementById('gifModal').style.display = 'flex';
        const container = document.getElementById('gifs');
        container.innerHTML = '';
        offset = 0;
        defaultTagIndex = 0;
        isUserSearch = false;

        // Pré-carrega a primeira tag genérica
        loadNextDefaultTag();
    }

    function closeModal() {
        document.getElementById('gifModal').style.display = 'none';
    }

    async function searchGif(newSearch = false) {
        const queryInput = document.getElementById('search').value.trim();
        if (!queryInput) return alert("Digite algo para buscar!");
        
        if (isLoading) return;

        if(newSearch) {
            currentQuery = queryInput;
            offset = 0;
            document.getElementById('gifs').innerHTML = '';
            isUserSearch = true;
        }

        await fetchAndAppendGifs(currentQuery, 12);
    }

    async function loadNextDefaultTag() {
        if(defaultTagIndex >= defaultTags.length) return;
        currentQuery = defaultTags[defaultTagIndex];
        offset = 0;
        await fetchAndAppendGifs(currentQuery, 12);
        defaultTagIndex++;
    }

    async function fetchAndAppendGifs(query, limit = 12) {
    if (isLoading) return;
    isLoading = true;

    // MOSTRA O LOADER
    const loader = document.getElementById('loaderGif');
    loader.style.display = 'flex';

    try {
        const response = await fetch(`https://api.giphy.com/v1/gifs/search?api_key=${apiKey}&q=${encodeURIComponent(query)}&limit=${limit}&offset=${offset}`);
        const data = await response.json();

        const container = document.getElementById('gifs');

        data.data.forEach(gif => {
            const img = document.createElement('img');
            img.src = gif.images.fixed_height.url;
            img.style.width = "150px";
            img.style.margin = "5px";
            img.style.cursor = "pointer";
            img.style.borderRadius = "8px";
            img.style.boxShadow = "var(--sombra)";
            img.onclick = () => sendGif(gif.images.fixed_height.url);
            container.appendChild(img);
        });

        offset += limit;
    } catch (error) {
        console.error(error);
    } finally {
        isLoading = false;
        loader.style.display = 'none'; // ESCONDE O LOADER
    }
}

    // Rolagem infinita
    document.getElementById('gifs').addEventListener('scroll', () => {
        const container = document.getElementById('gifs');
        if (container.scrollTop + container.clientHeight >= container.scrollHeight - 10) {
            if(isUserSearch && currentQuery) {
                // busca do usuário
                searchGif(false);
            } else {
                // pré-carregamento de tags genéricas
                loadNextDefaultTag();
            }
        }
    });

    function sendGif(url) {
        fetch("/mood-gif", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ image_url: url })
        })
        .then(() => {
            closeModal();
            location.reload()
        })
        .catch(err => console.error(err));
    }
</script>

