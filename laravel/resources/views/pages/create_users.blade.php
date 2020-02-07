@extends('layouts.app')

@section('content')
    <h3 class="text-center">Creation d'un utilisateur</h3>
    {!! Form::open(['action' => 'UsersController@store', 'method' => 'post']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Nom', ['class' => 'control-label']) !!}
        {!! Form::text('name', '', ['class' => 'form-control','placeholder' => 'Nom de l\'utilisateur'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
        {!! Form::text('email', '', ['class' => 'form-control','placeholder' => 'Email de l\'utilisateur'])!!}
    </div>
    <div class="form-group">
        {!! Form::label('status', 'Statut', ['class' => 'control-label']) !!}
        {!! Form::select('status', ['admin' => 'Administrateur', 'user' => 'Utilisateur']) !!}
    </div>
    {!! Form::submit('Créer cet utilisateur', ['class' => ' btn btn-lg btn-dark']) !!}
    {!! Form::close() !!}
@endsection
