<?php

namespace App\View\Components\Ticket\Category;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Name extends Component
{
    public $name;
    /**
     * Create a new component instance.
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ticket.category.name');
    }
}
