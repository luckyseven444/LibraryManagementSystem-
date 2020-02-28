<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Author;


class VueJSController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//    public function autocomplete()
//    {
//        return view('vuejsAutocomplete');
//    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocompleteSearch(Request $request)
    {
        $searchquery = $request->searchquery;
        $data = Author::where('first_name','like','%'.$searchquery.'%')->get();

        return response()->json($data);
    }
}