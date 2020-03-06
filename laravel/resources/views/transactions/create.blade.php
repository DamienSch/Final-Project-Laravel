@extends('layouts.app')

@section('content')
    <div class="text-right">Mon solde est de : <span class="text-success" >{{$moneyAccount}}&nbsp;€</span></div>
    <hr class="mt-1">
    <h3 class="text-center">Acheter des {{$currencysDB[0]->currency_name}}</h3>
    <hr>
    <?php
    setlocale(LC_TIME, 'fr_FR','fra');
    date_default_timezone_set('Europe/Paris');
    $currrencyApiId = $currencysDB[0]->API_id
    ?>
    <p class="text-success mt-5">Aujourd'hui : <strong>{{strftime("%A %d %B") }}</strong> à <strong>{{date("H:i")}}</strong> la valeur d'un <strong>{{$currencysDB[0]->currency_name}}</strong> est actuellement de <strong class="lead">{{round($response->$currrencyApiId->EUR,4)}}&nbsp;€&nbsp;*</strong></p>
    {!! Form::open(['action' => 'TransactionController@store', 'method' => 'post']) !!}
    @csrf
    <div class="form-group d-flex flex-column pt-4 pb-5">
        {!! Form::label('investisment', 'Investissement', ['class' => 'control-label']) !!}
        {!! Form::number('investisment', 'value',['type' => 'number', 'min' => 1, 'placeholder' => 'Montant à investir en euro']); !!}
    </div>
    <hr>
    <small>*Attention : la valeur d'achat de la monnaie est susceptible de varier en fonction de la seconde à laquelle l'achat a été effectué</small>
    <hr>
    <div class="text-center">
        {!! Form::submit('Acheter', ['class' => 'btn btn-lg btn-outline-success']) !!}
    </div>
    {!! Form::close() !!}
@endsection
