<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// model 
use App\Models\Movie;

class MovieController extends Controller
{
    //
    public function show ($id) {

        $movie = Movie::find($id);
        
        return view('member.movie-detail',compact('movie'));
    }       
}
