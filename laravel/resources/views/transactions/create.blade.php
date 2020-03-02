@extends('layouts.app')

@section('content')
    <h3 class="text-center">Acheter des {{$currencysDB[0]->currency_name}}</h3>
    {!! Form::open(['action' => 'TransactionController@store', 'method' => 'post']) !!}
    <div class="form-group">
        {!! Form::hidden('crypto_id',$currencysDB[0]->id)!!}
    </div>
    {{-- Montant des dépenses --}}
    <div class="form-group">
        {!! Form::label('expense_amount', 'Valeur en euro à investir', ['class' => 'control-label']) !!}
        {!! Form::number('expense_amount', 'value',['type' => 'number', 'min' => 1, 'placeholder' => '... €']); !!}
    </div>
    {{-- Valeur de la monnaie --}}
    <div class="form-group">
        {!! Form::hidden('currency_value', '0'); !!}
    </div>
    {{-- Date d'achat --}}
    <div class="form-group">
        {{ Form::hidden('date_of_purchase', date('Y-m-d'))}}
    </div>
    <div class="form-group">
        {{ Form::hidden('purchase_quantity', '0')}}
    </div>
    <hr>
    <div class="text-center">
        {!! Form::submit('Acheter', ['class' => ' btn btn-lg btn-dark']) !!}
    </div>
    {!! Form::close() !!}
@endsection
