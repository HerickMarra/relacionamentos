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
        
        @php
            $loveLanguage = auth()->user()->loveLanguage;
            $hasResults = $loveLanguage && ($loveLanguage->words_of_affirmation + $loveLanguage->acts_of_service + $loveLanguage->receiving_gifts + $loveLanguage->quality_time + $loveLanguage->physical_touch) > 0;
            $partner = \App\Models\User::where('id', '!=', auth()->id())->first();
            $partnerName = $partner ? explode(' ', $partner->name)[0] : 'seu amor';
        @endphp

        @if($hasResults)
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
                                <span style="font-size: 0.75em; font-weight: bold; color: var(--deep-pink)">{{ $loveLanguage->$key }}/5</span>
                            </div>
                            <div class="bar-outer">
                                <div class="bar-inner" style="width: {{ ($loveLanguage->$key / 5) * 100 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if($loveLanguage->analysis)
                    <div class="analysis-box">
                        {!! (new \Parsedown())->text($loveLanguage->analysis) !!}
                    </div>
                @endif

                <a href="{{ route('love-languages.quiz') }}" class="cute-btn" style="margin-top: 10px; font-size: 0.9em; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2);">Refazer Meu Quiz</a>
            </div>

            @php
                $partnerLoveLanguage = $partner ? $partner->loveLanguage : null;
                $hasPartnerResults = $partnerLoveLanguage && ($partnerLoveLanguage->words_of_affirmation + $partnerLoveLanguage->acts_of_service + $partnerLoveLanguage->receiving_gifts + $partnerLoveLanguage->quality_time + $partnerLoveLanguage->physical_touch) > 0;
            @endphp

            @if($hasPartnerResults)
                <div class="cute-card" style="margin-top: 10px;">
                    <p style="font-weight: 800; font-size: 1.2em; color: var(--deep-pink); margin: 0;">Perfil de {{ $partnerName }}</p>
                    <div class="results-summary">
                        @foreach($langs as $key => $data)
                            <div class="bar-item">
                                <div class="bar-header">
                                    <span class="bar-label"><i class="bi {{ $data['icon'] }}"></i> {{ $data['label'] }}</span>
                                    <span style="font-size: 0.75em; font-weight: bold; color: var(--deep-pink)">{{ $partnerLoveLanguage->$key }}/5</span>
                                </div>
                                <div class="bar-outer">
                                    <div class="bar-inner" style="width: {{ ($partnerLoveLanguage->$key / 5) * 100 }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($partnerLoveLanguage->analysis)
                        <div class="analysis-box" style="border-left: 5px solid var(--cute-pink);">
                            {!! (new \Parsedown())->text($partnerLoveLanguage->analysis) !!}
                        </div>
                    @endif
                </div>

                @php
                    $compatibility = \App\Models\CompatibilityAnalysis::where('user_id_1', min(Auth::id(), $partner->id))
                        ->where('user_id_2', max(Auth::id(), $partner->id))
                        ->first();
                @endphp

                @if($compatibility)
                    <div class="cute-card" style="margin-top: 20px; background: linear-gradient(135deg, rgba(255, 107, 107, 0.15) 0%, rgba(38, 38, 38, 0.8) 100%) !important; border: 2px solid var(--deep-pink);">
                        <div class="heart-animation" style="font-size: 2rem; margin-bottom: 5px;"><i class="bi bi-infinity"></i></div>
                        <p style="font-weight: 800; font-size: 1.3em; color: white; margin: 0;">💑 Sintonia do Casal</p>
                        <div class="analysis-box" style="background: rgba(0,0,0,0.2); border: none; font-size: 0.9em; margin-top: 15px;">
                            {!! (new \Parsedown())->text($compatibility->analysis) !!}
                        </div>
                    </div>
                @endif
            @else
                <div class="cute-card" style="margin-top: 10px; opacity: 0.8; border: 1px dashed rgba(255,255,255,0.2);">
                    <p style="font-weight: 800; font-size: 1.1em; color: #999; margin: 0;">Perfil de {{ $partnerName }}</p>
                    <p class="cute-subtitle" style="font-size: 0.8em;">
                        {{ $partnerName }} ainda não completou o quiz. <br>
                        Assim que ela terminar, o resultado aparecerá aqui!
                    </p>
                </div>
            @endif
        @else
            <div class="cute-card" style="padding: 40px 30px;">
                <div class="heart-animation" style="margin-bottom: 10px;"><i class="bi bi-balloon-heart-fill"></i></div>
                <p style="font-weight: 800; font-size: 1.3em; color: var(--deep-pink); margin: 0;">Descubra sua Linguagem!</p>
                <p class="cute-subtitle">
                    Você ainda não descobriu como prefere dar e receber amor. <br><br>
                    Faça o nosso quiz exclusivo para fortalecer sua conexão com <b>{{ $partnerName }}</b>! ❤️
                </p>
                <a href="{{ route('love-languages.quiz') }}" class="cute-btn" style="margin-top: 15px; box-shadow: 0 10px 20px rgba(255, 107, 107, 0.4);">Começar Descoberta</a>
            </div>

            @php
                $partnerLoveLanguage = $partner ? $partner->loveLanguage : null;
                $hasPartnerResults = $partnerLoveLanguage && ($partnerLoveLanguage->words_of_affirmation + $partnerLoveLanguage->acts_of_service + $partnerLoveLanguage->receiving_gifts + $partnerLoveLanguage->quality_time + $partnerLoveLanguage->physical_touch) > 0;
            @endphp

            @if($hasPartnerResults)
                <div class="cute-card blur-lock" style="margin-top: 20px; opacity: 1; padding: 0; height: auto; min-height: 120px; border: 1px solid rgba(255, 107, 107, 0.3); box-shadow: 0 0 20px rgba(255, 107, 107, 0.1); width: 100%; box-sizing: border-box;">
                    <div class="blur-content" style="filter: blur(15px); padding: 20px; display: flex; flex-direction: column; gap: 8px;">
                         <p style="font-weight: 800; font-size: 1.1em; color: #666; margin: 0;">Perfil de {{ $partnerName }}</p>
                         <div style="height: 10px; background: rgba(255,255,255,0.05); width: 100%; border-radius: 10px;"></div>
                         <div style="height: 10px; background: rgba(255,255,255,0.05); width: 80%; border-radius: 10px;"></div>
                    </div>
                    <div class="blur-overlay" style="background: linear-gradient(135deg, rgba(0,0,0,0.85) 0%, rgba(30,0,0,0.75) 100%); flex-direction: row; gap: 12px; padding: 15px; justify-content: flex-start; position: absolute; top: 0; left: 0; width: 100%; height: 100%; box-sizing: border-box; display: flex; align-items: center;">
                        <div style="position: relative; flex-shrink: 0;">
                            <img src="{{ $partner->profile_picture }}" alt="{{ $partnerName }}" style="width: 55px; height: 55px; border-radius: 50%; border: 2px solid var(--deep-pink); object-fit: cover; box-shadow: 0 0 10px rgba(255, 107, 107, 0.4);">
                            <div style="position: absolute; bottom: -3px; right: -3px; background: var(--deep-pink); width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid #1a1a1a;">
                                <i class="bi bi-lock-fill" style="color: white; font-size: 0.7em;"></i>
                            </div>
                        </div>
                        <div style="color: white; text-align: left; flex: 1; min-width: 0;">
                            <p style="margin: 0; font-size: 0.95em; font-weight: 800; color: var(--deep-pink); line-height: 1.2;">{{ $partnerName }} enviou o perfil!</p>
                            <p style="margin: 4px 0 0 0; font-size: 0.75em; font-weight: 500; line-height: 1.3; color: #ccc;">
                                Faça o seu teste agora para comparar suas linguagens. ❤️
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <a href="{{ route('painel') }}" style="color: grey; font-size: 0.9em; text-decoration: underline;">Voltar ao Painel</a>

    </div>

    <x-NavBar/>

    @include('painel.importsScript')
</body>
</html>
