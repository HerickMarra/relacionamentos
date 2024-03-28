<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavBar extends Component
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
        $buttons = [

                [
                    'color' => "#FF5C00",
                    'icon' =>  "bi bi-house-door-fill",
                    'link' => '/painel'
                ],

                [
                    'color' => "#FF5C00",
                    'icon' =>  "bi bi-images",
                    'link' => '/record'
                ],
                [
                    'color' => "#0494E4",
                    'icon' =>  "bi bi-calendar-range",
                    'link' => ''
                ],
                [
                    'color' => "#0494E4",
                    'icon' =>  "bi bi-gift-fill",
                    'link' => ''
                ],
                // [
                //     'color' => "#FF5C00",
                //     'icon' =>  "bi bi-bar-chart-line",
                //     'link' => ''
                // ],

            ];
        return view('components.nav-bar',compact('buttons'));
    }
}
