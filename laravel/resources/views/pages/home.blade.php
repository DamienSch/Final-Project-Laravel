@extends('layouts.app')

@section('content')
<h3>coucou</h3>
@foreach( $response as $currency => $val)
<p>{{($currency)}} : {{$val['EUR']}}</p>
@endforeach

@endsection
