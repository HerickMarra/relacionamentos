<?php

namespace App\View\Components;

use App\Models\Notification;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Notificacao extends Component
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
        $countN = Notification::where('user_id', Auth()->user()->id)->where('status', 'pendente')->count();
        return view('components.notificacao', compact('countN'));
    }
}
