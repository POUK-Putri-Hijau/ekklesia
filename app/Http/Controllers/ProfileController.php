<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    public function index(): Factory|View
    {
        return view('profile');
    }
}
