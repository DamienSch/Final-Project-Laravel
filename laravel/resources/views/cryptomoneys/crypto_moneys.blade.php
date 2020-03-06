@extends('layouts.app')

@section('content')
    <div class="text-right">Mon solde est de : <span class="text-success" >{{$moneyAccount}}&nbsp;€</span></div>
    <hr class="mt-1">
    <h3 class="text-center mb-3">Les cryptomonnaies</h3>
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" scope="col">Cryptomonnaies</th>
            <th class="text-center" scope="col">Sigles</th>
            <th class="text-center" scope="col">Prix</th>
            <th class="text-center" scope="col"></th>
            @if (Auth::user()->status == 'client')
                <th class="text-center" scope="col"></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach( $response as $currency => $val)
            <tr>
                <td class="text-center">{{$cryptoIds[$currency]}}</td>
                <td class="text-center">{{$currency}}</td>
                <td class="text-center">{{$val['EUR']}}&nbsp;€</td>
                <td class="text-center"><a href="{{ route('currency_history', $currency )}}">historique</a></td>
                @if (Auth::user()->status == 'client')
                    <td class="text-center"><a href="{{ route('transaction.create', $currency )}}" type="button" class="btn btn-outline-success">Acheter</a></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
