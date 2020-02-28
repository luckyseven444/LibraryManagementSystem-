<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class VueJsGenreController extends Controller
{
    public function autocompleteSearch(Request $request)
    {
        $searchquery = $request->searchquery;
        $data = Genre::where('name','like','%'.$searchquery.'%')->get();

        return response()->json($data);
    }
}
