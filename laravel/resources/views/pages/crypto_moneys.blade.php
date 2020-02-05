@extends('layouts.app')

@section('content')
    <h3>money money money</h3>
    <div class="d-flex justify-content-between align-items-center flex-row">
        <ul class="list-group col-md-4">
            <li class="list-group-item">Bitcoin :</li>
            <li class="list-group-item">Ethereum :</li>
            <li class="list-group-item">Ripple :</li>
            <li class="list-group-item">Bitcoin Cash :</li>
            <li class="list-group-item">Cardona :</li>
            <li class="list-group-item">Litecoin :</li>
            <li class="list-group-item">NEM :</li>
            <li class="list-group-item">Stellar :</li>
            <li class="list-group-item">IOTA :</li>
            <li class="list-group-item">Dash :</li>
        </ul>
        <ul class="list-group col-md-4">
            @foreach( $response as $currency => $val)
                <li class="list-group-item">({{($currency)}})&nbsp;:&nbsp;{{$val['EUR']}}&nbsp;€</li>
            @endforeach
        </ul>
        <ul class="list-group col-md-4">
            <li class="list-group-item"><a href="{{ route('bitcoin_history') }}">historique</a></li>
{{--            <li class="list-group-item"><a href="{{ route('ethereum_history') }}">historique</a></li>--}}
{{--            <li class="list-group-item"><a href="{{ route('ripple_history') }}">historique</a></li>--}}
{{--            <li class="list-group-item"><a href="{{ route('bitcoin_cash_history') }}">historique</a></li>--}}
{{--            <li class="list-group-item"><a href="{{ route('cardona_history') }}">historique</a></li>--}}
{{--            <li class="list-group-item"><a href="{{ route('litecoin_history') }}">historique</a></li>--}}
{{--            <li class="list-group-item"><a href="{{ route('nem_history') }}">historique</a></li>--}}
{{--            <li class="list-group-item"><a href="{{ route('stellar_history') }}">historique</a></li>--}}
{{--            <li class="list-group-item"><a href="{{ route('iota_history') }}">historique</a></li>--}}
{{--            <li class="list-group-item"><a href="{{ route('dash_history') }}">historique</a></li>--}}
        </ul>
    </div>

@endsection
