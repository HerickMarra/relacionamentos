<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\LoveLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\LoveLanguageAI;
use App\Models\CompatibilityAnalysis;

class LoveLanguageController extends Controller
{
    use LoveLanguageAI;

    public function index()
    {
        $user = Auth::user();
        $userLoveLanguage = LoveLanguage::firstOrCreate(['user_id' => $user->id]);
        
        // Robust Auto-Repair: ensure individual and compatibility analyses are valid
        $hasUserResults = ($userLoveLanguage->words_of_affirmation + $userLoveLanguage->acts_of_service + $userLoveLanguage->receiving_gifts + $userLoveLanguage->quality_time + $userLoveLanguage->physical_touch) > 0;
        
        if ($hasUserResults && !$this->isAnalysisValid($userLoveLanguage->analysis)) {
            $this->generateIndividualAnalysis($user, $userLoveLanguage);
            $userLoveLanguage->refresh();
        }

        $partner = \App\Models\User::where('id', '!=', $user->id)->first();
        $partnerLoveLanguage = null;
        $compatibility = null;

        if ($partner) {
            $partnerLoveLanguage = LoveLanguage::where('user_id',  $partner->id)->first();
            if ($partnerLoveLanguage) {
                $hasPartnerResults = ($partnerLoveLanguage->words_of_affirmation + $partnerLoveLanguage->acts_of_service + $partnerLoveLanguage->receiving_gifts + $partnerLoveLanguage->quality_time + $partnerLoveLanguage->physical_touch) > 0;

                // Repair Partner Individual
                if ($hasPartnerResults && !$this->isAnalysisValid($partnerLoveLanguage->analysis)) {
                    $this->generateIndividualAnalysis($partner, $partnerLoveLanguage);
                    $partnerLoveLanguage->refresh();
                }

                // Repair Compatibility
                if ($hasUserResults && $hasPartnerResults) {
                    $compatibility = CompatibilityAnalysis::where('user_id_1', min($user->id, $partner->id))
                        ->where('user_id_2', max($user->id, $partner->id))
                        ->first();

                    if (!$compatibility || !$this->isAnalysisValid($compatibility->analysis)) {
                        $this->generateCompatibilityAnalysis($user, $partner);
                        $compatibility = CompatibilityAnalysis::where('user_id_1', min($user->id, $partner->id))
                            ->where('user_id_2', max($user->id, $partner->id))
                            ->first(); // Re-fetch to get new content
                    }
                }
            }
        }

        return view('love-languages.index', [
            'userLoveLanguage' => $userLoveLanguage,
            'partner' => $partner,
            'partnerLoveLanguage' => $partnerLoveLanguage,
            'compatibility' => $compatibility
        ]);
    }

    private function isAnalysisValid($analysis)
    {
        if (empty($analysis)) return false;
        
        // If it's too short, it's likely a bug or cut off
        if (strlen($analysis) < 20) return false;
        
        // Check for common error keywords from AI proxies
        $errorKeywords = ['error', 'exception', 'openrouter', 'limit', 'falha', 'erro', 'calculando', 'processando'];
        foreach ($errorKeywords as $keyword) {
            if (stripos($analysis, $keyword) !== false) return false;
        }
        
        return true;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'words_of_affirmation' => 'required|integer|min:0|max:5',
            'acts_of_service' => 'required|integer|min:0|max:5',
            'receiving_gifts' => 'required|integer|min:0|max:5',
            'quality_time' => 'required|integer|min:0|max:5',
            'physical_touch' => 'required|integer|min:0|max:5',
        ]);

        $loveLanguage = LoveLanguage::updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return redirect()->route('painel')->with('success', 'Linguagens do amor atualizadas!');
    }

    public function reprocess()
    {
        $user = Auth::user();
        $loveLanguage = $user->loveLanguage;
        
        if (!$loveLanguage) {
            return response()->json(['status' => 'error', 'message' => 'Você ainda não fez o teste.'], 400);
        }

        // 1. Regenerate Individual Analysis
        $this->generateIndividualAnalysis($user, $loveLanguage);

        // 2. Regenerate Compatibility Analysis
        $partner = \App\Models\User::where('id', '!=', $user->id)->first();
        if ($partner && $partner->loveLanguage) {
            $this->generateCompatibilityAnalysis($user, $partner);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Análise recalculada com sucesso! ✨',
            'analysis' => $user->loveLanguage->fresh()->analysis
        ]);
    }
}
