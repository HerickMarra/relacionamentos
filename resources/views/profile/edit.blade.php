<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    @include('painel.importsHeader')
    <link rel="stylesheet" href="{{ asset("css/love-languages/cute.css?v=$version") }}">
    <style>
        .profile-photo-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 20px;
            cursor: pointer;
        }
        .profile-photo-preview {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid var(--deep-pink);
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(255,107,107,0.3);
            transition: 0.3s;
        }
        .profile-photo-container:hover .profile-photo-preview {
            filter: brightness(0.7);
        }
        .edit-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 1.5rem;
            opacity: 0;
            transition: 0.3s;
        }
        .profile-photo-container:hover .edit-overlay {
            opacity: 1;
        }
    </style>
</head>
<body class="flexCenter-c" style="background: var(--background);">
    <x-layout.load-intermedio />

    <div class="areaMobile cute-container">
        <div style="width: 100%; display: flex; justify-content: flex-start; margin-bottom: 10px;">
            <a href="/painel" style="color: white; text-decoration: none; font-size: 1.2rem;">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <div class="cute-card">
            <h2 class="cute-title">Editar Perfil</h2>
            <p class="cute-subtitle">Deixe seu perfil com a sua cara ✨</p>

            <form id="profileForm" onsubmit="saveProfile(event)">
                @csrf
                <div class="profile-photo-container" onclick="document.getElementById('photoInput').click()">
                    <img id="preview" src="{{ $user->profile_picture ?? asset('img/default-avatar.png') }}" class="profile-photo-preview">
                    <div class="edit-overlay"><i class="bi bi-camera-fill"></i></div>
                    <input type="file" id="photoInput" accept="image/*" style="display: none;" onchange="previewImage(this)">
                </div>

                <div style="text-align: left; margin-bottom: 20px;">
                    <label style="color: #bbb; font-size: 0.8em; margin-left: 15px; margin-bottom: 5px; display: block;">Seu Nome</label>
                    <input type="text" id="userName" value="{{ $user->name }}" class="inputText-lite" style="width: 100%; box-sizing: border-box;" required>
                </div>

                <button type="submit" id="saveBtn" class="cute-btn" style="width: 100%;">Salvar Alterações</button>
            </form>
        </div>

        <x-NavBar />
    </div>

    @include('painel.importsScript')
    <script>
        let base64Image = null;

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    base64Image = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function saveProfile(e) {
            e.preventDefault();
            const saveBtn = document.getElementById('saveBtn');
            const originalText = saveBtn.innerText;
            
            saveBtn.innerText = "Salvando...";
            saveBtn.disabled = true;

            fetch("{{ route('profile.update') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    name: document.getElementById('userName').value,
                    image: base64Image
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Perfil atualizado com sucesso! ✨');
                    window.location.href = "/painel";
                } else {
                    alert('Erro ao salvar: ' + data.message);
                    saveBtn.innerText = originalText;
                    saveBtn.disabled = false;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ops! Algo deu errado.');
                saveBtn.innerText = originalText;
                saveBtn.disabled = false;
            });
        }
    </script>
</body>
</html>
