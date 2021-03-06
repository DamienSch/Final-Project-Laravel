@extends('layouts.app')

@section('content')
    <h3 class="text-center">Modification de l'utilisateur</h3>
    {!! Form::open(['action' => ['UsersController@update',$user->id], 'method' => 'post']) !!}
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
        {!! Form::label('status', 'Statut', ['class' => 'control-label']) !!}
        {!! Form::select('status', ['client' => 'Utilisateur','admin' => 'Administrateur']) !!}
    </div>
    <hr>
    {!! Form::hidden('_method', 'PUT', ['id' => 'id']) !!}
    <div class="text-center">
        {!! Form::submit('Confirmer', ['class' => ' btn btn-lg btn-dark']) !!}
    </div>
    {!! Form::close() !!}
@endsection
