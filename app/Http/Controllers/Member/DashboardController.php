<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// model 
use App\Models\Movie;
class DashboardController extends Controller
{
    //
    public function index() {
        $movies = Movie::orderBy('featured','desc')
                ->orderBy('created_at','desc')
                ->get();
        return view('member.dashboard',compact('movies'));
    }
}
