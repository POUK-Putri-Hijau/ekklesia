<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(): RedirectResponse|Factory|View
    {
        if (!Auth::check()) {
            return redirect()->route('index');
        }

        $user = auth()->user();
        $role = $user->role ?? '';
        return view("dashboard/$role");
    }
}
