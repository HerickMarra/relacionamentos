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
        ['A' => 'Gosto de receber bilhetes de carinho.', 'catA' => 'words_of_affirmation', 'B' => 'Gosto de ser abraçado(a).', 'catB' => 'physical_touch'],
        ['A' => 'Gosto de passar tempo a sós com você.', 'catA' => 'quality_time', 'B' => 'Sinto-me amado(a) quando você me ajuda com as tarefas.', 'catB' => 'acts_of_service'],
        ['A' => 'Gosto quando você me dá um presente.', 'catA' => 'receiving_gifts', 'B' => 'Gosto de passear com você.', 'catB' => 'quality_time'],
        ['A' => 'Sinto-me amado(a) quando você faz coisas para me ajudar.', 'catA' => 'acts_of_service', 'B' => 'Gosto quando você me toca.', 'catB' => 'physical_touch'],
        ['A' => 'Gosto quando você coloca o braço em volta de mim.', 'catA' => 'physical_touch', 'B' => 'Gosto quando você me dá um pequeno presente.', 'catB' => 'receiving_gifts'],
        ['A' => 'Gosto de sair com você para qualquer lugar.', 'catA' => 'quality_time', 'B' => 'Gosto de segurar sua mão.', 'catB' => 'physical_touch'],
        ['A' => 'Sinto-me amado(a) quando você me elogia.', 'catA' => 'words_of_affirmation', 'B' => 'Valorizo quando você me dá um presente.', 'catB' => 'receiving_gifts'],
        ['A' => 'Gosto de sentar perto de você.', 'catA' => 'physical_touch', 'B' => 'Gosto quando você diz que sou bonito(a).', 'catB' => 'words_of_affirmation'],
        ['A' => 'Gosto de passar tempo conversando com você.', 'catA' => 'quality_time', 'B' => 'Gosto de receber pequenos mimos seus.', 'catB' => 'receiving_gifts'],
        ['A' => 'Dizer palavras de incentivo é importante para mim.', 'catA' => 'words_of_affirmation', 'B' => 'Sinto-me amado(a) quando você faz algo que eu detesto fazer.', 'catB' => 'acts_of_service'],
        ['A' => 'Gosto quando você faz algo especial para mim.', 'catA' => 'acts_of_service', 'B' => 'Gosto quando você me dá um presente que comprou.', 'catB' => 'receiving_gifts'],
        ['A' => 'Gosto quando você me ouve atentamente.', 'catA' => 'quality_time', 'B' => 'Gosto de receber elogios sobre minhas conquistas.', 'catB' => 'words_of_affirmation'],
        ['A' => 'Sinto-me amado(a) quando você me ajuda quando estou cansado(a).', 'catA' => 'acts_of_service', 'B' => 'Gosto de ir a lugares só nós dois.', 'catB' => 'quality_time'],
        ['A' => 'Gosto quando você me beija inesperadamente.', 'catA' => 'physical_touch', 'B' => 'Gosto quando você me diz "obrigado(a)" por algo que fiz.', 'catB' => 'words_of_affirmation'],
        ['A' => 'Sinto-me bem quando você traz uma lembrancinha da rua.', 'catA' => 'receiving_gifts', 'B' => 'Sinto-me bem quando você está por perto de mim.', 'catB' => 'physical_touch'],
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
            $cat = $ans['category'];
            if (isset($scores[$cat])) {
                $scores[$cat]++;
                $detailedAnalysisData[] = "- {$ans['question']}: Escolheu '{$ans['choice']}'";
            }
        }

        $normalized = [];
        foreach ($scores as $key => $val) {
            $normalized[$key] = min(5, ceil($val * 5 / 6));
        }

        $loveLanguage = LoveLanguage::updateOrCreate(['user_id' => Auth::id()], $normalized);

        // Individual AI
        $this->generateIndividualAnalysis(Auth::user(), $loveLanguage, $detailedAnalysisData);

        // Compatibility AI
        $partner = \App\Models\User::where('id', '!=', Auth::id())->first();
        if ($partner && $partner->loveLanguage) {
            $this->generateCompatibilityAnalysis(Auth::user(), $partner);
        }

        return response()->json(['success' => true]);
    }
}
