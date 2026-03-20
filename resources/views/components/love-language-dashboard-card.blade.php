<div class="cute-card" style="margin: 20px auto; padding: 20px; border: 1px solid rgba(255, 107, 107, 0.2); width: 80% !important;">
    @if(!$userLoveLanguage || ($userLoveLanguage->words_of_affirmation + $userLoveLanguage->acts_of_service + $userLoveLanguage->receiving_gifts + $userLoveLanguage->quality_time + $userLoveLanguage->physical_touch == 0))
        {{-- CASE: User hasn't done the quiz --}}
        @if($partnerLoveLanguage && ($partnerLoveLanguage->words_of_affirmation + $partnerLoveLanguage->acts_of_service + $partnerLoveLanguage->receiving_gifts + $partnerLoveLanguage->quality_time + $partnerLoveLanguage->physical_touch > 0))
            {{-- Curiosity Card: Partner did it, User didn't --}}
            <div style="text-align: center; position: relative; padding: 10px 0;">
                <div style="display: flex; justify-content: center; align-items: center; gap: -15px; margin-bottom: 15px;">
                    <div style="width: 55px; height: 55px; border-radius: 50%; background-image: url({{ $partner->profile_picture }}); background-size: cover; border: 2px solid var(--cute-pink); filter: blur(1px); position: relative; z-index: 2;"></div>
                    <div style="width: 45px; height: 45px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; border: 1px dashed var(--cute-pink); margin-left: -15px; backdrop-filter: blur(5px);">
                        <i class="bi bi-lock-fill" style="color: var(--cute-pink); font-size: 1.2rem;"></i>
                    </div>
                </div>
                
                <h3 style="color: white; font-size: 1.1em; font-weight: 800; margin-bottom: 8px;">
                    Como o coração de {{ explode(' ', $partner->name)[0] }} bate? 💓
                </h3>
                <p style="color: #bbb; font-size: 0.85em; line-height: 1.4; margin-bottom: 18px; padding: 0 20px;">
                    Seu amor já revelou <b>os segredos dele!</b> <br>
                    Descubra como enchê-lo de carinho agora mesmo.
                </p>
                
                <a href="{{ route('love-languages.index') }}" class="cute-btn" style="padding: 10px 25px; font-size: 0.85em; box-shadow: 0 5px 15px rgba(255,107,107,0.3); text-decoration: none; display: inline-block;">
                    Desbloquear Resultado 🔓
                </a>
            </div>
        @else
            {{-- Default: No one did it --}}
            <div style="text-align: center; padding: 10px;">
                <p style="font-weight: 800; color: var(--deep-pink); margin-bottom: 5px;">❤️ Linguagens do Amor</p>
                <p style="font-size: 0.85em; color: #bbb; margin-bottom: 15px;">Descobrem como vocês gostam de ser amados.</p>
                <a href="{{ route('love-languages.index') }}" class="cute-btn" style="padding: 10px 20px; font-size: 0.9em;">Começar Desafio</a>
            </div>
        @endif
    @else
        {{-- CASE: User HAS results --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <p style="font-weight: 800; color: var(--deep-pink); margin: 0;">✨ Seu Jeitinho de Amar</p>
            <a href="{{ route('love-languages.index') }}" style="font-size: 0.75em; color: #FF8E8E; text-decoration: none; font-weight: 700;">Nossa Sintonia ›</a>
        </div>

        @php
            $langs = [
                'words_of_affirmation' => ['label' => 'Palavras', 'icon' => 'bi-chat-quote-fill'],
                'acts_of_service' => ['label' => 'Atos', 'icon' => 'bi-stars'],
                'receiving_gifts' => ['label' => 'Presentes', 'icon' => 'bi-gift-fill'],
                'quality_time' => ['label' => 'Tempo', 'icon' => 'bi-clock-history'],
                'physical_touch' => ['label' => 'Toque', 'icon' => 'bi-hand-index-thumb']
            ];
            $userTop = collect($userLoveLanguage->toArray())->only(array_keys($langs))->sortDesc()->take(2);
        @endphp

        <div style="display: flex; gap: 8px; margin-bottom: 15px;">
            @foreach($userTop as $key => $val)
                <span style="background: rgba(255, 107, 107, 0.15); color: #FFB7B7; padding: 6px 12px; border-radius: 12px; font-size: 0.8em; font-weight: 700; border: 1px solid rgba(255,107,107,0.2);">
                    <i class="bi {{ $langs[$key]['icon'] }}"></i> {{ $langs[$key]['label'] }}
                </span>
            @endforeach
        </div>

        @if($userLoveLanguage->analysis)
            <p style="font-size: 0.85em; color: #ccc; line-height: 1.4; margin-bottom: 0; font-style: italic; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; opacity: 0.8;">
                {{ Str::limit(strip_tags((new \Parsedown())->text($userLoveLanguage->analysis)), 120) }}
            </p>
        @endif

        @if($partnerLoveLanguage && ($partnerLoveLanguage->words_of_affirmation + $partnerLoveLanguage->acts_of_service + $partnerLoveLanguage->receiving_gifts + $partnerLoveLanguage->quality_time + $partnerLoveLanguage->physical_touch > 0))
            <div style="margin-top: 15px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.05); display: flex; align-items: center; gap: 10px;">
                <div style="width: 30px; height: 30px; border-radius: 50%; background-image: url({{ $partner->profile_picture }}); background-size: cover; border: 1px solid var(--cute-pink);"></div>
                <div style="flex: 1;">
                    <p style="font-size: 0.75em; color: #888; margin: 0;">Linguagem de <b>{{ $partner->name }}</b>:</p>
                    @php
                        $partnerTop = collect($partnerLoveLanguage->toArray())->only(array_keys($langs))->sortDesc()->take(1);
                    @endphp
                    @foreach($partnerTop as $key => $val)
                        <span style="font-size: 0.8em; color: var(--cute-pink); font-weight: 700;">
                           <i class="bi {{ $langs[$key]['icon'] }}"></i> {{ $langs[$key]['label'] }}
                        </span>
                    @endforeach
                </div>
            </div>
        @endif
    @endif
</div>