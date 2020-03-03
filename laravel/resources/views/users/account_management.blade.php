@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column bd-highlight mb-3">
        <h3 class="text-center mb-3">Mes données personnelles</h3>
        <table class="table table-hover">
        <thead>
        <tr>
            <td>Nom d'utilisateur : {{$selfData[0]->name}}</td>
        </tr><tr>
            <td>Mail : {{$selfData[0]->email}}</td>
        </tr><tr>
            <td>Mot de passe : *********</td>
        </tr>
        </thead>
    </table>
        <div class="d-flex justify-content-center">
            <a class="btn btn-lg btn-outline-success" href="{{route('update_account')}}">Modifier mes données</a>
        </div>
    </div>
@endsection
