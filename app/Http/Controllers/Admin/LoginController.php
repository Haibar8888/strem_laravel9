<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('admin.auth.auth');
    }

    public function authenticate(Request $request)
    {
         $request->validate([
            'email' => 'required|email',
            'password' => 'required',
         ],
    );

        $credentials = $request->only('email', 'password');
        $credentials['role'] = 'admin';

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infoLogin)) {
           
           return redirect()->route('admin.movie');
        }
           return back()->withErrors([
                'error' => 'Invalid'
           ]);
    }
}
