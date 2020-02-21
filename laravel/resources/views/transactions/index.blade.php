@extends('layouts.app')

@section('content')
    <h3 class="text-center">Mes transactions</h3>
    @if(count($transactions) >= 1)
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Date d'achat</th>
                <th scope="col">Prix d'achat</th>
                <th scope="col">Valeur actuelle</th>
                <th scope="col" class="text-right">Vendre</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $trans)
                <tr>
                    <td>{{$trans->crypto_id}}</td>
                    <td>{{$trans->date_of_purchase}}</td>
                    <td>{{$trans->expense_amount}}</td>
                    <td>{{$trans->currency_value}}</td>
                    <td><a href=""></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="col-12">
            <div class="mx-auto d-flex pagination container justify-content-center">
                {{$transactions->links()}}
            </div>
        </div>
    @else
        <p class="text-muted">vous n'avez pas encore de cryptomonnaie ...</p>
    @endif
@endsection
