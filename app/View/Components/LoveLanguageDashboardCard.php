<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoveLanguageDashboardCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $user = auth()->user();
        $userLoveLanguage = $user->loveLanguage;
        $partner = User::where('id', '!=', $user->id)->with('loveLanguage')->first();
        $partnerLoveLanguage = $partner ? $partner->loveLanguage : null;

        return view('components.love-language-dashboard-card', compact(
            'user', 
            'userLoveLanguage', 
            'partner', 
            'partnerLoveLanguage'
        ));
    }
}
