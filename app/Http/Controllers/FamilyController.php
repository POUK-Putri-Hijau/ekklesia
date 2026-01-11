<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FamilyController extends Controller
{
    public function index(): Factory|View
    {
        return view('families.index');
    }

    public function create(): Factory|View
    {
        return view('families.create');
    }

    public function edit(): Factory|View
    {
        return view('families.edit');
    }
}
