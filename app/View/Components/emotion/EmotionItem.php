<?php

namespace App\View\Components\emotion;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmotionItem extends Component
{
    /**
     * Create a new component instance.
     */

     public $emotion;
     public $image;
    public function __construct($emotion = null, $image = null){
        $this->emotion = $emotion;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // if(!$this->emotion){return '';}

        $emotion = $this->emotion;
        $image = $this->image;
        return view('components.emotion.emotion-item', compact('emotion', 'image'));
    }
}
