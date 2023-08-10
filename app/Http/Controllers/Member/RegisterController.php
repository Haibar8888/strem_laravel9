<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// models
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function index() {
        return view('member.register');
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $data = $request->except('_token');

        $isEmailExist = User::where('email',$request->email)->exists();

        if ($isEmailExist) {
            return back()->withErrors([
                'email' => "Email sudah terdaftar"
            ])->withInput();
        }

        $data['role'] = 'member';
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return back();
    }
}
