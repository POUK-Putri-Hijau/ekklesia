<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddFamily extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.forms.add-family');
    }
}
