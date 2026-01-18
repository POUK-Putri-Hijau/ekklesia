<?php

namespace App\View\Components\ListRow;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MemberRow extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.list-row.member');
    }
}
