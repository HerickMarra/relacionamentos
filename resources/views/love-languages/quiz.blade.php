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
                    <button class="option-btn" id="optionA" onclick="selectOption('A')"></button>
                    <div class="or-divider">OU</div>
                    <button class="option-btn" id="optionB" onclick="selectOption('B')"></button>
                </div>
            </div>

            <div id="finish-card" class="finish-card" style="display: none;">
                <i class="bi bi-check-circle-fill" style="font-size: 3rem; color: #FF6B6B;"></i>
                <h2>Quiz Concluído!</h2>
                <p>Estamos processando seu perfil...</p>
                <button class="clearBtn btnAct" onclick="finishQuiz()">Ver Resultado</button>
            </div>
        </div>
    </div>

    <x-NavBar/>

    <script>
        const questions = @json($questions);
        let currentStep = 0;
        let answers = [];

        function updateCard() {
            if (currentStep < questions.length) {
                const q = questions[currentStep];
                document.getElementById('optionA').innerText = q.A;
                document.getElementById('optionB').innerText = q.B;
                document.getElementById('progress').style.width = ((currentStep / questions.length) * 100) + '%';
            } else {
                document.getElementById('question-card').style.display = 'none';
                document.getElementById('finish-card').style.display = 'flex';
                document.getElementById('progress').style.width = '100%';
            }
        }

        function selectOption(choice) {
            const q = questions[currentStep];
            answers.push(choice === 'A' ? q.catA : q.catB);
            currentStep++;
            updateCard();
        }

        async function finishQuiz() {
            const response = await fetch("{{ route('love-languages.quiz.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ answers: answers })
            });

            if (response.ok) {
                window.location.href = "{{ route('love-languages.index') }}";
            }
        }

        updateCard();
    </script>
    @include('painel.importsScript')
</body>
</html>
