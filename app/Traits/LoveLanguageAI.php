<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use App\Models\CompatibilityAnalysis;

trait LoveLanguageAI
{
    protected function generateIndividualAnalysis($user, $loveLanguage, $detailedAnswers = [])
    {
        $apiKey = env('OPENROUTER_API_KEY');
        if (!$apiKey) return;

        $detailedText = count($detailedAnswers) > 0 ? implode("\n", $detailedAnswers) : "Dados baseados no perfil preenchido.";
        $scores = [
            'words_of_affirmation' => $loveLanguage->words_of_affirmation,
            'acts_of_service' => $loveLanguage->acts_of_service,
            'receiving_gifts' => $loveLanguage->receiving_gifts,
            'quality_time' => $loveLanguage->quality_time,
            'physical_touch' => $loveLanguage->physical_touch,
        ];

        $detailedText = count($detailedAnswers) > 0 ? implode("\n", $detailedAnswers) : "Dados baseados no perfil preenchido.";
        
        $prompt = "Analise as escolhas e scores deste usuário no teste das 5 Linguagens do Amor: \n" .
                  "Respostas Reais: {$detailedText}\n\n" .
                  "Scores Finais: " . json_encode($scores) . ".\n" .
                  "Seja EXTREMAMENTE conciso (máximo 150 palavras no total).\n" .
                  "Estrutura curta:\n" .
                  "1. **Seu Perfil**: 1 frase sobre sua essência.\n" .
                  "2. **Dica para o Amor**: 2 exemplos práticos baseados nas escolhas acima.\n" .
                  "3. **Dica de Ouro**: 1 frase final de impacto.\n" .
                  "Use um tom acolhedor e romântico.";

        $response = $this->callOpenRouter($prompt, $apiKey, 'Você é um assistente romântico direto e minimalista. Escreva de forma ultra-resumida.');

        if ($response) {
            $loveLanguage->update(['analysis' => $response]);
        }
    }

    protected function generateCompatibilityAnalysis($user1, $user2)
    {
        $apiKey = env('OPENROUTER_API_KEY');
        if (!$apiKey) return;

        $scores1 = $user1->loveLanguage->only(['words_of_affirmation', 'acts_of_service', 'receiving_gifts', 'quality_time', 'physical_touch']);
        $scores2 = $user2->loveLanguage->only(['words_of_affirmation', 'acts_of_service', 'receiving_gifts', 'quality_time', 'physical_touch']);

        $prompt = "Compare estes dois perfis românticos: \n" .
                  "{$user1->name}: " . json_encode($scores1) . "\n" .
                  "{$user2->name}: " . json_encode($scores2) . "\n\n" .
                  "Gere uma análise ULTRA-RESUMIDA de compatibilidade (máximo 200 palavras no total).\n" .
                  "### 💫 Sincronia: 1 parágrafo curto sobre como eles se completam.\n" .
                  "### 🎁 Para {$user1->name}: 1 dica curta de como agradar {$user2->name}.\n" .
                  "### 💝 Para {$user2->name}: 1 dica curta de como agradar {$user1->name}.\n" .
                  "### ⚡ Desafio: 1 frase direta para fortalecer a conexão.";

        $response = $this->callOpenRouter($prompt, $apiKey, 'Você é um terapeuta de casais apaixonado e sábio.');

        if ($response) {
            CompatibilityAnalysis::updateOrCreate(
                ['user_id_1' => min($user1->id, $user2->id), 'user_id_2' => max($user1->id, $user2->id)],
                ['analysis' => $response]
            );
        }
    }

    private function callOpenRouter($prompt, $apiKey, $systemMessage)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'HTTP-Referer' => config('app.url'),
                'Content-Type' => 'application/json',
            ])->post('https://openrouter.ai/api/v1/chat/completions', [
                'model' => 'arcee-ai/trinity-large-preview:free',
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            if ($response->successful()) {
                return $response->json('choices.0.message.content');
            } else {
                \Log::error("OpenRouter Error: " . $response->status() . " - " . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            \Log::error("AI Exception: " . $e->getMessage());
            return null;
        }
    }
}
