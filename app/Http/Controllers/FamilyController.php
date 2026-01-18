<?php

namespace App\Http\Controllers;

use App\Models\FamilyTotalMember;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class FamilyController extends Controller
{
    public function index(): Factory|View
    {
        $families = FamilyTotalMember::all();
        return view('families.index', ['families' => $families]);
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
