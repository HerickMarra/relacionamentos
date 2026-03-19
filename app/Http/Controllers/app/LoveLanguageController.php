<?php

namespace App\Http\Controllers\app;

use App\Http\Controllers\Controller;
use App\Models\LoveLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoveLanguageController extends Controller
{
    public function index()
    {
        $loveLanguage = LoveLanguage::firstOrCreate(['user_id' => Auth::id()]);
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
