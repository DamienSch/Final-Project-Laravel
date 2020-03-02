@extends('layouts.app')

@section('content')
    <h3 class="text-center">Acheter des {{$currencysDB[0]->currency_name}}</h3>
    {!! Form::open(['action' => 'TransactionController@store', 'method' => 'post']) !!}
    <div class="form-group">
        {!! Form::hidden('crypto_id',$currencysDB[0]->id)!!}
    </div>
    <div class="form-group">
        {!! Form::label('purchase_quantity', 'Quantité', ['class' => 'control-label']) !!}
        {!! Form::number('purchase_quantity', 'value',['type' => 'number', 'min' => 1,]); !!}
    </div>
    <div class="form-group">
        {!! Form::label('sale_amount', 'Montant de la vente', ['class' => 'control-label']) !!}
        {!! Form::number('sale_amount', 'value'); !!}
    </div>
    <div class="form-group">
        {!! Form::hidden('expense_amount', '0'); !!}
    </div>
    <div class="form-group">
        {!! Form::hidden('currency_value', '0'); !!}
    </div>
    <div class="form-group">
        {{ Form::hidden('date_of_purchase', date('Y-m-d'))}}
    </div>
    <hr>
    <div class="text-center">
        {!! Form::submit('Acheter', ['class' => ' btn btn-lg btn-dark']) !!}
    </div>
    {!! Form::close() !!}
@endsection
