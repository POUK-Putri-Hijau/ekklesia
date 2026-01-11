<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $email = $request->input('email');
        if (!$email) {
            return Response::json(['error' => 'Maaf, Anda harus memasukkan email.'], 400);
        }

        $password = $request->input('password');
        if (!$password) {
            return Response::json(['error' => 'Maaf, Anda harus memasukkan kata sandi.'], 400);
        }

        $validator = Validator::make($request->all(), [
            "email"=> 'required|email|min:7|max:64',
            "password"=> 'required|min:8|max:64'
        ]);

        if ($validator->fails()) {
            return Response::json(
                ['error' => 'Gagal masuk akun, mohon pastikan email dan kata sandi sudah benar.'],
                400
            );
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return response()->json();
        }

        return Response::json(['error' => 'Maaf, email Anda masukkan salah, mohon cek ulang email Anda.'], 404);
    }
}
