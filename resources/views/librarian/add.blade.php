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

                    <form action="{{route('books.store')}}" method="POST">
                        @csrf
                        <input type="text" name="title" placeholder="Book title">
                        <autocomplete></autocomplete>
                        <autocomplete-genre></autocomplete-genre>
                        <input type="number" placeholder="ISBN" name="ISBN">
                        <input type="number" placeholder="Price" name="price">
                        <input type="date" name="date_of_publication" placeholder="Date Of Publication">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
