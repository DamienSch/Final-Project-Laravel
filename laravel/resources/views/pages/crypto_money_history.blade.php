@extends('layouts.app')

@section('content')
    <h3>Valeur du Bitcoin des 30 derniers jours</h3>
    <div class="d-flex justify-content-right align-items-center flex-row">
        <ul class="list-group">
            @for ($today=0; $today<=30; $today++)
                <li class="list-group-item">{{date('d-m-Y', strtotime('today - '.$today.' days'))}}</li>
            @endfor
        </ul>
        <ul class="list-group">
            @foreach($response as $item)
                <li class="list-group-item">{{$item->close}} €</li>
            @endforeach
        </ul>
    </div>

@endsection
