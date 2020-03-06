@extends('layouts.app')

@section('content')
    <div class="text-right">Mon solde est de : <span class="text-success" >{{$moneyAccount}}&nbsp;€</span></div>
    <hr class="mt-1">
    <h3 class="text-center">Modification de mes données personnelles</h3>
    {!! Form::open(['action' => ['UsersController@updateAccount'],Auth::user()->id, 'method' => 'post']) !!}
    @csrf
    <div class="form-group">
        {!! Form::label('name', 'Nom', ['class' => 'control-label']) !!}
        {!! Form::text('name', $user->name, ['class' => 'form-control','placeholder' => 'Nom de l\'utilisateur'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
        {!! Form::text('email', $user->email, ['class' => 'form-control','placeholder' => 'Email de l\'utilisateur'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('password', 'Mot de passe', ['class' => 'control-label']) !!}
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Facultatif'])!!}
    </div>
    <hr>
    <div class="text-center">
        {!! Form::submit('Confirmer', ['class' => ' btn btn-lg btn-dark']) !!}
    </div>
    {!! Form::close() !!}
@endsection
