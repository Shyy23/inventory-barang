<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $paginator;
    public $routeName;
    public $routeParams;

    /**
     * Create a new component instance.
     */
    public function __construct($paginator, $routeName = null, $routeParams = [])
    {
        $this->paginator = $paginator;
        $this->routeName = $routeName;
        $this->routeParams = $routeParams;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination');
    }
}