@extends('layouts.app')

@section('content')
    <h3>money money money</h3>
    @foreach($response as $item)
        <p>{{$item->close}}</p>
    @endforeach

@endsection
