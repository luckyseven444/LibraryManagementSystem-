<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public $author;
    public $genre;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('author', 'genre')->get();
        return view('librarian.index', compact(['books']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarian.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $request->has('author') ? $this->author = explode(" ", $request->author):$this->author = explode(" ", $request->author1);
        $request->has('genre') ? $this->genre=$request->genre : $this->genre=$request->genre1;

        Book::create(['title'=> $request->title,
            'price' => $request->price,
            'author_id' => \App\Author::where('first_name', $this->author[0])->where('last_name', $this->author[1])->first()->id,
            'genre_id' => \App\Genre::where('name', $this->genre)->first()->id,
            'date_of_publication' => $request->date_of_publication,
            'ISBN' => $request->ISBN
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //The system admin have this priv
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = \App\Book::find($id);
        $author = \App\Author::find($book->author_id);
        return view('librarian.edit', compact('book','author'));
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
        $this->validation($request);

        $request->has('author') ? $this->author = explode(" ", $request->author):$this->author = explode(" ", $request->author1);
        $request->has('genre') ? $this->genre=$request->genre : $this->genre=$request->genre1;

        Book::updateOrCreate(['id' => $id],[
            'title'=> $request->title,
            'price' => $request->price,
            'author_id' => \App\Author::where('first_name', $this->author[0])->where('last_name', $this->author[1])->first()->id,
            'genre_id' => \App\Genre::where('name', $this->genre)->first()->id,
            'date_of_publication' => $request->date_of_publication,
            'ISBN' => $request->ISBN
        ]);

        return redirect('home')->with('success', 'Book updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect('books')->with('success', 'Book deleted!');
    }

    public function validation($request){
         $request->validate([
            'title'=> 'required' ,
            'author' =>'sometimes|required' ,
             'author1' =>'sometimes|required' ,
            'genre' => 'sometimes|required' ,
             'genre1' =>'sometimes|required' ,
            'date_of_publication' => 'required' ,
            'ISBN' => 'required'
        ]);
    }
}
