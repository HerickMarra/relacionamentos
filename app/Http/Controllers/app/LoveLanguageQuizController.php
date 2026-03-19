<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\LoveLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoveLanguageQuizController extends Controller
{
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
        $answers = $request->input('answers'); // expecting array of categories
        
        $scores = [
            'words_of_affirmation' => 0,
            'acts_of_service' => 0,
            'receiving_gifts' => 0,
            'quality_time' => 0,
            'physical_touch' => 0,
        ];

        foreach ($answers as $cat) {
            if (isset($scores[$cat])) {
                $scores[$cat]++;
            }
        }

        // Normalize to a 1-5 scale for the database (optional, but good for consistency)
        // Max score in any category could be 6ish in this 15q quiz
        // Let's just store the raw counts or normalize manually.
        // The original view was 1-5. Let's map raw count 0-6 to 0-5.
        $normalized = [];
        foreach ($scores as $key => $val) {
            $normalized[$key] = min(5, ceil($val * 5 / 6)); // Rough normalization
        }

        $loveLanguage = LoveLanguage::updateOrCreate(
            ['user_id' => Auth::id()],
            $normalized
        );

        // IA Analysis (OpenRouter)
        $apiKey = env('OPENROUTER_API_KEY');
        if ($apiKey) {
            try {
                $prompt = "Analise estruturada dos resultados do teste de Linguagens do Amor (Escala 0-5): " . 
                          "Palavras de Afirmação: {$normalized['words_of_affirmation']}, " .
                          "Atos de Serviço: {$normalized['acts_of_service']}, " .
                          "Receber Presentes: {$normalized['receiving_gifts']}, " .
                          "Tempo de Qualidade: {$normalized['quality_time']}, " .
                          "Toque Físico: {$normalized['physical_touch']}. " .
                          "O objetivo é fornecer uma análise profunda e profissional em português. " .
                          "Siga rigorosamente esta estrutura: " .
                          "1. **Seu Perfil Principal**: Identifique a linguagem predominante e explique o que ela significa emocionalmente para você. " .
                          "2. **Como seu parceiro pode te amar**: Dê 3 exemplos práticos e românticos baseados na sua pontuação. " .
                          "3. **Conselho de Ouro**: Um conselho final para fortalecer a conexão do casal baseada nesse perfil. " .
                          "Escreva em um tom acolhedor, romântico e maduro, em primeira pessoa.";

                $response = Http::withHeaders([
                    'Authorization' => "Bearer {$apiKey}",
                    'HTTP-Referer' => config('app.url'),
                    'Content-Type' => 'application/json',
                ])->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'google/gemini-2.0-pro-exp-02-05:free', // Or any other model
                    'messages' => [
                        ['role' => 'system', 'content' => 'Você é um assistente romântico especialista em linguagens do amor.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                ]);

                if ($response->successful()) {
                    $analysis = $response->json('choices.0.message.content');
                    $loveLanguage->update(['analysis' => $analysis]);
                }
            } catch (\Exception $e) {
                // Fail silently or log
            }
        }

        return response()->json(['success' => true]);
    }
}
