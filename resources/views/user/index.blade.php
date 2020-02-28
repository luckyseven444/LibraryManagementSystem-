@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <h1 class="display-3">Borrowed Books</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Book</td>
                        <td>Author</td>
                        <td>Date</td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{$book->id}}</td>
                            <td>{{$book->stocks->book->title}}</td>
                            <td>{{$book->stocks->book->author->first_name}} {{$book->stocks->book->author->last_name}}</td>
                            <td>{{$book->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <h1 class="display-3">Books Return Reminder</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>Book</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($final as $book)
                        <tr>
                            <td>{{$book['title']}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                </div>
            </div>
        </div>
    </div>
@endsection
