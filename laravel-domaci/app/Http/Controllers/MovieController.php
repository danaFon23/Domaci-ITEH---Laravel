<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $movies = Movie::all();
        return new MovieCollection($movies); 
        
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
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:150',
            'raiting' => 'required',
            'description' => 'required|string|max:255',
            'year' => 'required|integer',
            'director_id' => 'required',
            'genre_id' => 'required',
        ]);
        if($validator->fails())
        return response()->json($validator->errors());

        $movie = Movie::create([
            'title' => $request->title,
            'raiting' =>$request->raiting,
            'description' => $request->description,
            'year' => $request->year,
            'director_id' => $request->director_id,
            'genre_id' => $request->genre_id,
            
        ]);

        return response()->json(['Film je uspesno kreiran!. Kreirao je korisnik '.$request->user()->name.'.', new MovieResource($movie)]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:150',
            'raiting' => 'required',
            'description' => 'required|string|max:255',
            'year' => 'required|integer',
            'director_id' => 'required',
            'genre_id' => 'required',

        ]);
        if($validator->fails())
        return response()->json($validator->errors());

        
        $movie->title = $request->title;
        $movie->raiting = $request->raiting;
        $movie->description = $request->description;
        $movie->year = $request->year;
        $movie->director_id =$request->director_id;
        $movie->genre_id = $request->genre_id;

        $movie->save();

        return response()->json(['Film je uspesno azuriran!.', new MovieResource($movie)]); //MovieResource znaci da vrati u MovieResource formatu.
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        return response()->json('Film je uspesno obrisan.');
    }
}
