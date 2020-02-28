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
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <form action="{{ route('checkouts.store') }}"  method="POST">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="number" placeholder="User Id" name="user_id">
                        <input type="number" placeholder="Book stock Id" name="stock_id">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>

                    <ul>
                    @foreach( $errors->all() as $message)
                        <li>
                            {{$message}}
                        </li>
                    @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
