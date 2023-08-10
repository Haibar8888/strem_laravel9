<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function index()
    {  
        // $user = User::all();
        // dd($user);
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
        // $credentials = $request->all();
        $credentials['role'] = 'admin';
        // dd($credentials);

        if (Auth::attempt($credentials))	 {
           $request->session()->regenerate();
           return redirect()->route('admin.movie');
        }
        return back()->withErrors([
            'error' => 'Credential invalid'
        ])->withInput();
        dd($credentials);
        }
       
}
