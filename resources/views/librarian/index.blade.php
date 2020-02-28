@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Genre</th>
                        <th>Publication Date</th>
                        <th>ISBN</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                    <tr>
                        <td>{{$book->title}}</td>
                        <td>{{$book->author->first_name}} {{$book->author->last_name}}</td>
                        <td>{{$book->price}}</td>
                        <td>{{$book->genre->name}}</td>
                        <td>{{$book->date_of_publication}}</td>
                        <td>{{$book->ISBN}}</td>
                        <td>
                            <a href="{{ route('books.edit',$book->id)}}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('books.destroy', $book->id)}}" method="post">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th>Genre</th>
                        <th>Publication Date</th>
                        <th>ISBN</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
