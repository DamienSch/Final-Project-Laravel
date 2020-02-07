@extends('layouts.app')

@section('content')
    <h3 class="text-center">Liste des utilisateurs</h3>
    <div class="container d-flex justify-content-end mb-3 col-md-12">
        <button type="button" class="btn btn-primary">Créer un utilisateur</button>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Mail</th>
            <th scope="col">Statut</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->status}}</td>
                <td><button type="button" class="btn btn-primary">Modifier</button></td>
                <td><button type="button" class="btn btn-danger">Supprimer</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
