<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class MemberController extends Controller
{
    public function index(): Factory|View
    {
        return view('members.index');
    }

    public function create(): Factory|View
    {
        return view('members.create');
    }
}
