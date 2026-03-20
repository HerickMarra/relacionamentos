<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz: Linguagens do Amor</title>
    @include('painel.importsHeader')
    <link rel="stylesheet" href="{{ asset("css/love-languages/cute.css?v=$version") }}">
    <link rel="stylesheet" href="{{ asset("css/love-languages/quiz.css?v=$version") }}">
</head>

<body class="flexCenter-c">
    <x-layout.load-intermedio />

    <div class="areaMobile cute-container">
        <div style="padding-top: 40px;"></div>
        <div class="heart-animation"><i class="bi bi-heart-fill"></i></div>
        <h1 class="cute-title">Quiz do Amor</h1>

        <div id="quiz-container">
            <div class="progress-bar">
                <div id="progress" style="width: 0%;"></div>
            </div>

            <div id="question-card" class="question-card">
                <p class="question-text">Qual dessas opções combina mais com você?</p>
                <div class="options">
                    <button class="option-btn" id="optionA" onclick="toggleOption('A')"></button>
                    <div class="or-divider">E/OU</div>
                    <button class="option-btn" id="optionB" onclick="toggleOption('B')"></button>
                </div>
                <button id="nextBtn" class="next-btn" onclick="nextStep()" disabled>Próxima</button>
            </div>

            <div id="finish-card" class="finish-card" style="display: none;">
                <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: #FF6B6B;"></i>
                <h2>Quiz Concluído!</h2>
                <p>Estamos processando seu perfil...</p>
                <button class="clearBtn btnAct" onclick="finishQuiz()">Ver Resultado</button>
            </div>
        </div>
    </div>

    <x-NavBar />

    <script>
        const questions = @json($questions);
        let currentStep = 0;
        let answers = [];
        let currentSelection = [];

        function updateCard() {
            if (currentStep < questions.length) {
                const q = questions[currentStep];
                document.getElementById('optionA').innerText = q.A;
                document.getElementById('optionB').innerText = q.B;

                // Clear selection
                currentSelection = [];
                document.getElementById('optionA').classList.remove('selected');
                document.getElementById('optionB').classList.remove('selected');
                document.getElementById('nextBtn').disabled = true;

                document.getElementById('progress').style.width = ((currentStep / questions.length) * 100) + '%';
            } else {
                document.getElementById('question-card').style.display = 'none';
                document.getElementById('finish-card').style.display = 'flex';
                document.getElementById('progress').style.width = '100%';
            }
        }

        function toggleOption(choice) {
            const index = currentSelection.indexOf(choice);
            if (index > -1) {
                currentSelection.splice(index, 1);
                document.getElementById('option' + choice).classList.remove('selected');
            } else {
                currentSelection.push(choice);
                document.getElementById('option' + choice).classList.add('selected');
            }

            document.getElementById('nextBtn').disabled = currentSelection.length === 0;
        }

        function nextStep() {
            const q = questions[currentStep];
            const selectedCats = currentSelection.map(c => c === 'A' ? q.catA : q.catB);
            const selectedChoices = currentSelection.map(c => c === 'A' ? q.A : q.B);

            answers.push({
                question: q.A + " vs " + q.B,
                choices: selectedChoices,
                categories: selectedCats
            });

            currentStep++;
            updateCard();
        }

        function finishQuiz() {
            const container = document.getElementById('quiz-container');
            container.innerHTML = `
                <div class="cute-card" style="text-align: center; padding: 50px 20px;">
                    <div class="heart-animation" style="font-size: 3.5rem; margin-bottom: 20px;">
                        <i class="bi bi-stars" style="color: var(--cute-pink);"></i>
                    </div>
                    <h2 style="color: white; font-weight: 800; margin-bottom: 15px;">Criando sua Mágica...</h2>
                    <p style="color: #bbb; font-size: 0.95em; line-height: 1.5;">
                        Nossa IA está analisando cada resposta sua para construir um perfil único e cheio de carinho. <br>
                        <b>Isso leva apenas alguns segundos! ✨</b>
                    </p>
                    <div style="margin-top: 30px;">
                        <div class="cute-loader"></div>
                    </div>
                </div>
            `;

            fetch("{{ route('love-languages.quiz.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                },
                body: JSON.stringify({ answers: answers }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = "{{ route('love-languages.index') }}";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ops! Algo deu errado. Tente novamente.');
                    window.location.reload();
                });
        }
        updateCard();
    </script>
    @include('painel.importsScript')
</body>

</html>