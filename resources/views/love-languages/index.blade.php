<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Linguagens do Amor</title>
    @include('painel.importsHeader')
    <link rel="stylesheet" href="{{ asset("css/love-languages/cute.css?v=$version") }}">
</head>
<body class="flexCenter-c">
    <x-layout.load-intermedio />

    <div class="areaMobile cute-container">
        <div style="padding-top: 40px;"></div>
        
        <div class="couple-header">
            <img src="{{ asset('img/marra.png') }}" alt="Herick" class="couple-photo">
            <div class="couple-divider"><i class="bi bi-heart-fill"></i></div>
            <img src="{{ asset('img/anne.png') }}" alt="Anne" class="couple-photo">
        </div>
        
        <h1 class="cute-title">Linguagens do Amor</h1>
        
        @if(auth()->user()->loveLanguage)
            <div class="cute-card">
                <p style="font-weight: 800; font-size: 1.2em; color: var(--deep-pink); margin: 0;">Seu Perfil de Amor</p>
                <div class="results-summary">
                    @php
                        $langs = [
                            'words_of_affirmation' => ['label' => 'Palavras de Afirmação', 'icon' => 'bi-chat-quote-fill'],
                            'acts_of_service' => ['label' => 'Atos de Serviço', 'icon' => 'bi-stars'],
                            'receiving_gifts' => ['label' => 'Receber Presentes', 'icon' => 'bi-gift-fill'],
                            'quality_time' => ['label' => 'Tempo de Qualidade', 'icon' => 'bi-clock-history'],
                            'physical_touch' => ['label' => 'Toque Físico', 'icon' => 'bi-hand-index-thumb']
                        ];
                    @endphp
                    @foreach($langs as $key => $data)
                        <div class="bar-item">
                            <div class="bar-header">
                                <span class="bar-label"><i class="bi {{ $data['icon'] }}"></i> {{ $data['label'] }}</span>
                                <span style="font-size: 0.75em; font-weight: bold; color: var(--deep-pink)">{{ auth()->user()->loveLanguage->$key }}/5</span>
                            </div>
                            <div class="bar-outer">
                                <div class="bar-inner" style="width: {{ (auth()->user()->loveLanguage->$key / 5) * 100 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if(auth()->user()->loveLanguage->analysis)
                    <div class="analysis-box">
                        {!! nl2br(e(auth()->user()->loveLanguage->analysis)) !!}
                    </div>
                @endif

                <a href="{{ route('love-languages.quiz') }}" class="cute-btn" style="margin-top: 10px; font-size: 0.9em; background: #999;">Refazer Quiz</a>
            </div>
        @else
            <div class="cute-card">
                <p class="cute-subtitle">
                    Descubra como você prefere dar e receber amor! Este quiz ajudará você e sua namorada a se conectarem de forma mais profunda.
                </p>
                <a href="{{ route('love-languages.quiz') }}" class="cute-btn">Começar Quiz</a>
            </div>
        @endif

        <a href="{{ route('painel') }}" style="color: grey; font-size: 0.9em; text-decoration: underline;">Voltar ao Painel</a>

    </div>

    <x-NavBar/>

    @include('painel.importsScript')
</body>
</html>
