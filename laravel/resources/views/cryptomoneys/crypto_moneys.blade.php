@extends('layouts.app')

@section('content')
    <h3 class="text-center">Les Cryptomonnaies</h3>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Cryptomonnaies</th>
            <th scope="col">Sigles</th>
            <th scope="col">Prix</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
            @foreach( $response as $currency => $val)
                <tr>
                    <td>{{$cryptoIds[$currency]}}</td>
                    <td>{{$currency}}</td>
                    <td>{{$val['EUR']}}&nbsp;€</td>
                    <td><a href="{{ route('currency_history', $currency )}}">historique</a></td>
                    <td><a href="{{ route('transaction.create', $currency )}}" type="button" class="btn btn-outline-success">Acheter</a></td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
