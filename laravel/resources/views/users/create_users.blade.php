@extends('layouts.app')

@section('content')
    <h3 class="text-center">Création d'un utilisateur</h3>
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
        {!! Form::label('password', 'Mot de passe', ['class' => 'control-label']) !!}
        {!! Form::password('password', ['class' => 'awesome control-label']); !!}
    </div>
    <div class="form-group">
        {!! Form::label('status', 'Statut', ['class' => 'control-label']) !!}
        {!! Form::select('status', ['client' => 'Utilisateur','admin' => 'Administrateur']) !!}
    </div>
    <hr>
    <div class="text-center">
        {!! Form::submit('Créer cet utilisateur', ['class' => ' btn btn-lg btn-dark']) !!}
    </div>
    {!! Form::close() !!}
@endsection
