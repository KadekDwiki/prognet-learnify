<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardClass extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $classId,
        public string $name,
        public string $teacher,
        public string $token
    ) {
        // dd($token);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-class');
    }
}