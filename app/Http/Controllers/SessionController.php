<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email_or_phone_number' => 'required',
            'password' => 'required',
        ]);
        if (stripos($credentials['email_or_phone_number'], '@')){
            $credentials['email'] = $credentials['email_or_phone_number'];
        } else {
            $credentials['phone_number'] = $credentials['email_or_phone_number'];
        }
        unset($credentials['email_or_phone_number']);
        if (Auth::attempt($credentials) == false) {
            return back()->withErrors([
                'message' => 'Логин или пароль неверны, пожалуйста попробуйте снова'
            ]);
        }
        return redirect()->to('/');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }
}
