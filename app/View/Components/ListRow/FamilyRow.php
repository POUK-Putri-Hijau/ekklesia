<?php

namespace App\View\Components\Icons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FamilyRow extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.list-row.family');
    }
}
