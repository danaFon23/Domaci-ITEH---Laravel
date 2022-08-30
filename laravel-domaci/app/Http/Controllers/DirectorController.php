<?php

namespace App\Http\Controllers;

use App\Http\Resources\DirectorCollection;
use App\Http\Resources\DirectorResource;
use App\Models\Director;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    public function index()
    {

        $directors = Director::all();
        return new DirectorCollection($directors); 
        
    }

    public function show(Director $director)
    {
        return new DirectorResource($director);
    }
}
