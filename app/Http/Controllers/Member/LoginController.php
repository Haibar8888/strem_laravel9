<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index() {
        return view('member.auth');
    }

    public function auth(Request $request) {

      $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
      
      $credentials = $request->only('email', 'password');
      $credentials['role'] = 'member';

      if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();
        return 'success';
      }
      
        return back()->withErrors([
           'credentials' => "Email atau Password Anda salah"
        ])->withInput();



    }

    public function logout() {

    }
}
