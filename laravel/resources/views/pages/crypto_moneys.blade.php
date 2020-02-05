@extends('layouts.app')

@section('content')
    <h3 class="text-center">Les crypto monnaies</h3>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Crypto monnaies</th>
            <th scope="col">Sigles</th>
            <th scope="col">Prix</th>
            <th scope="col">Historique</th>
        </tr>
        </thead>
        <tbody>
            @foreach( $response as $currency => $val)
                <tr>
                    <td>{{$cryptoIds[$currency]}}</td>
                    <td>{{$currency}}</td>
                    <td>{{$val['EUR']}}&nbsp;€</td>
                    <td><a href="{{ route('bitcoin_history', $currency )}}">historique</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
