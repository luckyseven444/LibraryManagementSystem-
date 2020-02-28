@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                    </div>

                    <form action="{{ route('books.update', $book->id) }}" method="POST">
                        @csrf @method('PATCH')

                        <input type="text" name="title" placeholder="Book title" value=@php echo $book->title; @endphp >
                        <autocomplete author=@php $author->name @endphp></autocomplete>
                        <autocomplete-genre></autocomplete-genre>
                        <input type="number" placeholder="ISBN" name="ISBN" value=@php echo $book->ISBN; @endphp>
                        <input type="number" placeholder="Price" name="price" value=@php echo $book->price; @endphp>
                        <input type="date" name="date_of_publication" placeholder="Date Of Publication" value=@php echo $book->date_of_publication; @endphp>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
