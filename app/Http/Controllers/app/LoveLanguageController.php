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
        
        // Auto-generate compatibility analysis if missing but both have results
        $partner = \App\Models\User::where('id', '!=', $user->id)->first();
        if ($partner && $partner->loveLanguage) {
            $hasUserResults = ($loveLanguage->words_of_affirmation + $loveLanguage->acts_of_service + $loveLanguage->receiving_gifts + $loveLanguage->quality_time + $loveLanguage->physical_touch) > 0;
            $hasPartnerResults = ($partner->loveLanguage->words_of_affirmation + $partner->loveLanguage->acts_of_service + $partner->loveLanguage->receiving_gifts + $partner->loveLanguage->quality_time + $partner->loveLanguage->physical_touch) > 0;

            if ($hasUserResults && $hasPartnerResults) {
                $compatibility = CompatibilityAnalysis::where('user_id_1', min($user->id, $partner->id))
                    ->where('user_id_2', max($user->id, $partner->id))
                    ->first();

                if (!$compatibility) {
                    $this->generateCompatibilityAnalysis($user, $partner);
                    // Refresh if needed, or just let the view handle the next load
                }
            }
        }

        return view('love-languages.index', compact('loveLanguage'));
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
}
