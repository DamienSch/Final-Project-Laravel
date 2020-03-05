@extends('layouts.app')

@section('content')
    <h3 class="text-center">Liste des utilisateurs</h3>
    <div class="container d-flex justify-content-end mb-3 col-md-12">
        <a role="button" class="btn btn-outline-success" href="{{ route('users_gestion/create') }}">Créer un utilisateur</a>
    </div>
    @if(count($users) >= 1)
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Mail</th>
            <th scope="col">Statut</th>
            <th scope="col" class="text-right">Modifier</th>
            <th scope="col">Supprimer</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->status}}</td>
                <td class="text-right"><a role="button" class="btn btn-outline-primary" href="{{ route('users_gestion') }}{{"/".$user->id}}">Modifier</a></td>
                <td>
                    {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'post']) !!}
                    @csrf
                    {!! Form::hidden('_method', 'DELETE', ['id' => 'id']) !!}
                    {!! Form::submit('Supprimer', ['class' => 'btn btn-outline-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="col-12">
        <div class="mx-auto d-flex pagination container justify-content-center">
            {{$users->links()}}
        </div>
    </div>
    @else
        <p class="text-muted">vous n'avez pas encore d'utilisateurs ...</p>
    @endif
@endsection
