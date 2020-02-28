@extends('errors::minimal')

@section('customMessage')
    Exception details: <b>{{ $exception->getMessage() }}</b>
@endsection