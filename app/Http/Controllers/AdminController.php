<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $count = \App\User::All()->count();
        $users = \App\User::whereBetween('id',[3, $count])->get();

        $genre_books =  \App\Book::select('genre', DB::raw('count(*) as total'))->groupBy('genre')->get('title');

        return view('admin.index', compact(['users', 'genre_books']));
    }
}
