<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
    public function edit(Movie $movie)
    {
        //
        return view('admin.movie.edit',compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Movie $movie)
    {
        //
         $data = $request->all();

         $request->validate([
            'title' => 'required|string',
            'small_thumbnail' => 'image|mimes:png,jpg,jpeg',
            'large_thumbnail' => 'image|mimes:png,jpg,jpeg',
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

       if ($request->small_thumbnail) {
            $smallThumbnail = $request->small_thumbnail;
            $originalSmallThumbnail = Str::random(10).$smallThumbnail->getClientOriginalName();
            $smallThumbnail->storeAs('public/thumbnail',$originalSmallThumbnail);
            $data['small_thumbnail'] = $originalSmallThumbnail;

            // delete old data
            Storage::delete('public/thumbnail/'.$movie->small_thumbnail);
       }

       if ($request->large_thumbnail) {
            $largeThumbnail = $request->large_thumbnail;
            $originalLargeThumbnail = Str::random(10).$largeThumbnail->getClientOriginalName();
            //    upload gambar
            $largeThumbnail->storeAs('public/thumbnail',$originalLargeThumbnail);
            // save data
            $data['large_thumbnail'] = $originalLargeThumbnail;
            // delete old data
            Storage::delete('public/thumbnail/'.$movie->large_thumbnail);
       }
            $movie->update($data);
            return redirect()->route('admin.movie.index')->with('success', 'Data Movie berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
        $movie->delete();
        return redirect()->route('admin.movie.index')->with('success', 'Data Movie berhasil dihapus');
    }
}
