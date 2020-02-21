@extends('layouts.app')

@section('content')
    <h3 class="text-center">Acheter une cryptomonaie</h3>
    {!! Form::open(['action' => 'TransactionController@store', 'method' => 'post']) !!}
    <div class="form-group">
        {!! Form::hidden('user_id', $user->id, ['class' => 'form-control','placeholder' => 'user id'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('crypto_id', 'Cryptomonnaie', ['class' => 'control-label']) !!}
        {!! Form::select('crypto_id',
            [
                '1' => 'Bitcoin',
                '2' => 'Ethereum',
                '3' => 'Ripple',
                '4' => 'Bitcoin Cash',
                '5' => 'Cardano',
                '6' => 'Litecoin',
                '7' => 'NEM',
                '8' => 'Stellar',
                '9' => 'IOTA',
                '10' => 'Dash',
            ])
            !!}
    </div>
    <div class="form-group">
        {!! Form::label('purchase_quantity', 'Quantité', ['class' => 'control-label']) !!}
        {!! Form::number('purchase_quantity', 'value',['type' => 'number', 'min' => 1,]); !!}
    </div>
    @foreach( $response as $currency => $val)
        <div class="form-group">
            {!! Form::label('expense_amount', 'Prix d\'achat', ['class' => 'control-label']) !!}
            {!! Form::number('expense_amount', $val->EUR,['step' => '0.01','type' => 'number', 'min' => 0]); !!}
        </div>
    @endforeach
    <div class="form-group">
        {!! Form::label('sale_amount', 'Montant de la vente', ['class' => 'control-label']) !!}
        {!! Form::number('sale_amount', 'value'); !!}
    </div>
    <div class="form-group">
        {!! Form::label('currency_value', 'Valeur de la cryptomonnaie', ['class' => 'control-label']) !!}
        {!! Form::number('currency_value', 'value'); !!}
    </div>
    <div class="form-group">
        {!! Form::label('soldes', 'A vendre', ['class' => 'control-label']) !!}
        {!! Form::number('soldes', '0'); !!}
    </div>
    <div class="form-group">
        {!! Form::label('date_of_purchase', 'Date d\'achat', ['class' => 'control-label']) !!}
        {{ Form::date('date_of_purchase', date('Y-m-d'))}}
    </div>
    <hr>
    <div class="text-center">
        {!! Form::submit('Acheter', ['class' => ' btn btn-lg btn-dark']) !!}
    </div>
    {!! Form::close() !!}
@endsection
