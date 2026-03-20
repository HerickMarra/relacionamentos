<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\LoveLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\LoveLanguageAI;

class LoveLanguageQuizController extends Controller
{
    use LoveLanguageAI;

    private $questions = [
        ['A' => 'Gosto quando você me diz o quanto me admira e me valoriza.', 'catA' => 'words_of_affirmation', 'B' => 'Sinto-me amado quando você lava a louça ou arruma a casa sem eu pedir.', 'catB' => 'acts_of_service'],
        ['A' => 'Amo quando desligamos os celulares para conversar sem interrupções.', 'catA' => 'quality_time', 'B' => 'Fico radiante quando você chega em casa com um doce ou uma lembrancinha surpresa.', 'catB' => 'receiving_gifts'],
        ['A' => 'Para mim, um abraço apertado ao chegar em casa é o melhor momento do dia.', 'catA' => 'physical_touch', 'B' => 'Ouvir um "tenho orgulho de você" me dá uma energia incrível.', 'catB' => 'words_of_affirmation'],
        ['A' => 'Valorizo muito quando você se oferece para resolver um problema chato para mim.', 'catA' => 'acts_of_service', 'B' => 'Adoro quando planejamos uma caminhada ou um passeio só nós dois.', 'catB' => 'quality_time'],
        ['A' => 'Guardo com muito carinho cada pequeno presente que você já me deu.', 'catA' => 'receiving_gifts', 'B' => 'Sinto-me seguro e amado quando estamos de mãos dadas.', 'catB' => 'physical_touch'],
        ['A' => 'Palavras de incentivo nos meus dias difíceis são o que eu mais preciso.', 'catA' => 'words_of_affirmation', 'B' => 'Gosto quando você assiste a um filme comigo prestando total atenção.', 'catB' => 'quality_time'],
        ['A' => 'Sinto seu amor quando você prepara minha comida favorita ou um café.', 'catA' => 'acts_of_service', 'B' => 'Amo receber presentes que mostram que você pensou em mim enquanto estava longe.', 'catB' => 'receiving_gifts'],
        ['A' => 'Gosto de receber carinhos no cabelo ou uma massagem rápida enquanto relaxamos.', 'catA' => 'physical_touch', 'B' => 'Fico muito feliz quando você me ajuda a organizar nossas coisas.', 'catB' => 'acts_of_service'],
        ['A' => 'O melhor presente é ter sua companhia exclusiva em um jantar especial.', 'catA' => 'quality_time', 'B' => 'Amo receber uma mensagem inesperada dizendo que você está com saudades.', 'catB' => 'words_of_affirmation'],
        ['A' => 'Sinto que sou importante para você quando você escolhe um presente com carinho.', 'catA' => 'receiving_gifts', 'B' => 'Amo quando você retira o lixo ou faz compras para me poupar esforço.', 'catB' => 'acts_of_service'],
        ['A' => 'Sentar bem juntinho no sofá é a minha forma favorita de passar o tempo.', 'catA' => 'physical_touch', 'B' => 'Gosto de compartilhar hobbies e atividades novas ao seu lado.', 'catB' => 'quality_time'],
        ['A' => 'Gosto quando você elogia minha aparência ou algo que eu fiz bem.', 'catA' => 'words_of_affirmation', 'B' => 'Amo quando você me traz algo que eu disse que queria há muito tempo.', 'catB' => 'receiving_gifts'],
        ['A' => 'Sinto-me cuidado quando você cuida das tarefas da casa para eu descansar.', 'catA' => 'acts_of_service', 'B' => 'Um beijo de despedida e um de chegada são essenciais para mim.', 'catB' => 'physical_touch'],
        ['A' => 'Valorizo momentos de conversa profunda onde compartilhamos nossos sonhos.', 'catA' => 'quality_time', 'B' => 'Gosto quando você me ajuda com as malas ou carrega algo pesado para mim.', 'catB' => 'acts_of_service'],
        ['A' => 'Para mim, o valor do presente está no gesto de você ter lembrado de mim.', 'catA' => 'receiving_gifts', 'B' => 'Gosto de receber cartões ou bilhetes escritos à mão com declarações.', 'catB' => 'words_of_affirmation'],
        ['A' => 'Ouvir você dizer "eu te amo" com frequência é vital para mim.', 'catA' => 'words_of_affirmation', 'B' => 'Adoro quando você me faz um carinho ou brinca fisicamente comigo.', 'catB' => 'physical_touch'],
        ['A' => 'Sinto seu apoio quando você me ajuda a planejar ou organizar minha semana.', 'catA' => 'acts_of_service', 'B' => 'Gosto de viajar com você, aproveitando cada minuto da sua presença.', 'catB' => 'quality_time'],
        ['A' => 'Amo quando você me ouve sem me julgar ou tentar dar soluções imediatas.', 'catA' => 'quality_time', 'B' => 'Gosto de dormir abraçado ou sentindo o seu toque.', 'catB' => 'physical_touch'],
        ['A' => 'Fico emocionado quando você me dá algo feito por você ou personalizado.', 'catA' => 'receiving_gifts', 'B' => 'Amo quando você faz pequenos reparos ou cuida de burocracias por mim.', 'catB' => 'acts_of_service'],
        ['A' => 'Gosto quando você conta para outras pessoas as coisas boas sobre mim.', 'catA' => 'words_of_affirmation', 'B' => 'Amo quando você me surpreende com um presente em datas comuns.', 'catB' => 'receiving_gifts'],
    ];

    public function index()
    {
        return view('love-languages.quiz', [
            'questions' => $this->questions
        ]);
    }

    public function store(Request $request)
    {
        $answers = $request->input('answers');

        $scores = [
            'words_of_affirmation' => 0,
            'acts_of_service' => 0,
            'receiving_gifts' => 0,
            'quality_time' => 0,
            'physical_touch' => 0,
        ];
        $detailedAnalysisData = [];

        foreach ($answers as $ans) {
            $isBoth = count($ans['categories']) > 1;
            foreach ($ans['categories'] as $index => $cat) {
                if (isset($scores[$cat])) {
                    $scores[$cat]++;
                    if (!$isBoth || $index === 0) {
                        $choiceText = ($isBoth) ? $ans['choices'][0] . " E " . $ans['choices'][1] : $ans['choices'][0];
                        $detailedAnalysisData[] = "- {$ans['question']}: Escolheu '{$choiceText}'";
                    }
                }
            }
        }

        $normalized = [];
        foreach ($scores as $key => $val) {
            $normalized[$key] = min(5, ceil($val * 5 / 8));
        }

        $loveLanguage = LoveLanguage::updateOrCreate(['user_id' => Auth::id()], $normalized);

        // Individual AI
        try {
            $this->generateIndividualAnalysis(Auth::user(), $loveLanguage, $detailedAnalysisData);
        } catch (\Exception $e) {
            \Log::error("Individual AI Error: " . $e->getMessage());
        }

        // Compatibility AI
        $partner = \App\Models\User::where('id', '!=', Auth::id())->first();
        if ($partner && $partner->loveLanguage) {
            try {
                $this->generateCompatibilityAnalysis(Auth::user(), $partner);
            } catch (\Exception $e) {
                \Log::error("Compatibility AI Error: " . $e->getMessage());
            }
        }

        return response()->json(['success' => true]);
    }
}
