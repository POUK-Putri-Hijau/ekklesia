<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(): Factory|View
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $name = $request->input('name');
        if (!$name) {
            return Response::json(['error' => 'Maaf, Anda harus memasukkan nama akun.'], 400);
        }

        $email = $request->input('email');
        if (!$email) {
            return Response::json(['error' => 'Maaf, Anda harus memasukkan email.'], 400);
        }

        $password = $request->input('password');
        if ($password && (strlen($password) < 8 || strlen($password) > 64)) {
            return Response::json(['error' => 'Maaf, kata sandi Anda terlalu pendek atau panjang.'], 400);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:60',
            "email"=> 'required|email|min:7|max:64',
            "password"=> 'nullable|min:8|max:64'
        ]);

        if ($validator->fails()) {
            return Response::json(
                ['error' => 'Gagal masuk akun, mohon pastikan email dan kata sandi sudah benar.'],
                400
            );
        }

        $user = auth()->user();
        $user['name'] = $name;
        $user['email'] = $email;

        if ($password) {
            $user['password'] = hashPassword($password);
        }

        $user->save();
        return response()->json();
    }
}

function hashPassword(string $password): string {
    $options = [
        'memory_cost' => 65536,
        'time_cost' => 1,
        'threads' => 3,
    ];
    return password_hash($password, PASSWORD_ARGON2ID, $options);
}
