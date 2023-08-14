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

      public function auth(Request $request) {

      $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
      
      $credentials = $request->only('email', 'password');
      $credentials['role'] = 'admin';

      if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $request->session()->regenerate();
        return redirect('admin/movie');
      }
      
        return back()->withErrors([
            'credentials' => "Your credentials are wrong"
        ])->withInput();
    }

    public function logout(Request $request) {
      
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
