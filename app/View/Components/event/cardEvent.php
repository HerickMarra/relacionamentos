<?php

namespace App\View\Components\event;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class cardEvent extends Component
{
    public $event;
    public function __construct($event = null)
    {
        $this->event = $event;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if(!$this->event){return '';}

        $event = $this->event;
        return view('components.event.card-event', compact('event'));
    }
}
