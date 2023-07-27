<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// model
use App\Models\Movie;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $movies = Movie::orderBy('created_at', 'desc')->get();
        return view('admin.movie.index',compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Movie $movie)
    {
        //
       $data = $request->except('_token');
       $request->validate([
            'title' => 'required|string',
            'small_thumbnail' => 'required|image|mimes:png,jpg,jpeg',
            'large_thumbnail' => 'required|image|mimes:png,jpg,jpeg',
            'trailer' => 'required|url',
            'movie' => 'required|url',
            'casts' => 'required|string',
            'categories' => 'required|string',
            'release_date' => 'required|string',
            'about' => 'required|string',
            'short_about' => 'required|string',
            'duration' => 'required|string',
            'featured' => 'required',
       ]);
       $smallThumbnail = $request->small_thumbnail;
       $largeThumbnail = $request->large_thumbnail;

       $originalSmallThumbnail = Str::random(10).$smallThumbnail->getClientOriginalName();
       $originalLargeThumbnail = Str::random(10).$largeThumbnail->getClientOriginalName();

    //    upload gambar
       $smallThumbnail->storeAs('public/thumbnail',$originalSmallThumbnail);
       $largeThumbnail->storeAs('public/thumbnail',$originalLargeThumbnail);

    // create data
       $data['small_thumbnail'] = $originalSmallThumbnail;
       $data['large_thumbnail'] = $originalLargeThumbnail;

       Movie::create($data);

       return redirect()->route('admin.movie.index')->with('success', 'Data Movie berhasil ditambhkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
