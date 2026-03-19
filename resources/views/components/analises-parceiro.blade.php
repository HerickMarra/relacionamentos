<link rel="stylesheet" href="{{ asset("components/analiseparceiro/analiseparceiro.css?v=$version") }}">
<link rel="stylesheet" href="{{ asset("css/love-languages/cute.css?v=$version") }}">

<p class="globalTitle">Visão geral</p>
<div class="X-AnaliseParceiro">
    @foreach ($users_Parceiros as $item)
        <div class="X-AnaliseParceiro-Parceiro">
            <div class="X-AnaliseParceiro-Parceiro-Perfil">
                <div style="background-image: url({{$item->profile_picture}})" class="X-AnaliseParceiro-Parceiro-Perfil-Picture"></div>
            </div>

            <div class="X-AnaliseParceiro-Parceiro-Analises">
                <p class="X-AnaliseParceiro-Parceiro-Analises-AV">Avaliações: {{count($item->emotions)}}</p>
                <p class="X-AnaliseParceiro-Parceiro-Analises-LL">{{lastLogin($item->last_login)}}</p>
                
                @if($item->loveLanguage)
                    @php
                        $hasSelfResult = auth()->user()->loveLanguage;
                        $isPartner = auth()->user()->id != $item->id;
                    @endphp

                    <div class="{{ (!$hasSelfResult && $isPartner) ? 'blur-lock' : '' }}">
                        <div class="{{ (!$hasSelfResult && $isPartner) ? 'blur-content' : '' }}">
                            <div class="love-language-mini-badge" style="margin-bottom: 8px;">
                                <i class="bi bi-heart-fill" style="color: #FF6B6B;"></i>
                                @php
                                    $langs = [
                                        'words_of_affirmation' => ['label' => 'Palavras', 'icon' => 'bi-chat-quote-fill'],
                                        'acts_of_service' => ['label' => 'Atos', 'icon' => 'bi-stars'],
                                        'receiving_gifts' => ['label' => 'Presentes', 'icon' => 'bi-gift-fill'],
                                        'quality_time' => ['label' => 'Tempo', 'icon' => 'bi-clock-history'],
                                        'physical_touch' => ['label' => 'Toque', 'icon' => 'bi-hand-index-thumb']
                                    ];
                                    $values = collect($item->loveLanguage->toArray())
                                        ->only(array_keys($langs))
                                        ->sortDesc()
                                        ->take(2);
                                @endphp
                                @foreach($values as $key => $val)
                                    @if($val > 0)
                                        <span class="badge-item" style="background: rgba(255, 107, 107, 0.2); border: 1px solid rgba(255, 107, 107, 0.3);">
                                            <i class="bi {{ $langs[$key]['icon'] }}"></i> {{ $langs[$key]['label'] }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                            @if($item->loveLanguage->analysis)
                                <div class="analysis-box" style="margin-top: 10px; background: rgba(255, 255, 255, 0.05); border-left: 2px solid #FF6B6B; padding: 12px; border-radius: 12px; border: 1px solid rgba(255,107,107,0.1);">
                                    <p style="font-size: 11px; color: #eee; font-style: italic; line-height: 1.5; margin: 0; opacity: 0.9;">
                                        {!! nl2br(e($item->loveLanguage->analysis)) !!}
                                    </p>
                                </div>
                            @endif
                        </div>

                        @if(!$hasSelfResult && $isPartner)
                            <div class="blur-overlay">
                                <a href="{{ route('love-languages.index') }}" class="blur-message" style="text-decoration: none;">
                                    ❤️ Faça o teste para liberar o resultado do seu amor!
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

                <a href="/emotion/{{$item->id}}"><button  class="clearBtn btnAct X-AnaliseParceiro-Parceiro-Analises-btn">Avaliações</button></a>
                @if (auth()->user()->id == $item->id)
                    <a style="margin-left: 10px;" href="#"><button  class="clearBtn btnAct X-AnaliseParceiro-Editar-Perfil-btn">Editar Perfil</button></a>
                @endif
            </div>
        </div>
    @endforeach

</div>
