<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Moodgif extends Component
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
        $usersGif = User::with(['latestMoodGif' => function ($q) {
            $q->where('created_at', '>=', now()->subDay());
        }])
        ->get();


        // dd($usersGif[0]->profile_picture);
        return view('components.moodgif', compact('usersGif'));
    }
}
