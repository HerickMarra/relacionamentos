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
        $loveLanguage = LoveLanguage::firstOrCreate(['user_id' => $user->id]);
        
        // Robust Auto-Repair: ensure individual and compatibility analyses are valid
        $hasUserResults = ($loveLanguage->words_of_affirmation + $loveLanguage->acts_of_service + $loveLanguage->receiving_gifts + $loveLanguage->quality_time + $loveLanguage->physical_touch) > 0;
        
        // 1. Repair User Individual Analysis
        if ($hasUserResults && !$this->isAnalysisValid($loveLanguage->analysis)) {
            $this->generateIndividualAnalysis($user, $loveLanguage);
            $loveLanguage->refresh();
        }

        $partner = \App\Models\User::where('id', '!=', $user->id)->first();
        if ($partner && $partner->loveLanguage) {
            $hasPartnerResults = ($partner->loveLanguage->words_of_affirmation + $partner->loveLanguage->acts_of_service + $partner->loveLanguage->receiving_gifts + $partner->loveLanguage->quality_time + $partner->loveLanguage->physical_touch) > 0;

            // 2. Repair Partner Individual Analysis (if missing or invalid)
            if ($hasPartnerResults && !$this->isAnalysisValid($partner->loveLanguage->analysis)) {
                $this->generateIndividualAnalysis($partner, $partner->loveLanguage);
            }

            // 3. Repair Compatibility
            if ($hasUserResults && $hasPartnerResults) {
                $compatibility = CompatibilityAnalysis::where('user_id_1', min($user->id, $partner->id))
                    ->where('user_id_2', max($user->id, $partner->id))
                    ->first();

                if (!$compatibility || !$this->isAnalysisValid($compatibility->analysis)) {
                    $this->generateCompatibilityAnalysis($user, $partner);
                }
            }
        }

        return view('love-languages.index', compact('loveLanguage'));
    }

    private function isAnalysisValid($analysis)
    {
        if (empty($analysis)) return false;
        
        // If it's too short, it's likely a bug or cut off
        if (strlen($analysis) < 50) return false;
        
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
