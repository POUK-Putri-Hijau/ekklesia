<?php

namespace App\View\Components\Inputs;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownFamilyItem extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.inputs.dropdowns.family');
    }
}
