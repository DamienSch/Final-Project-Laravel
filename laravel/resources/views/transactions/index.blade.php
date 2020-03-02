@extends('layouts.app')

@section('content')
    <h3 class="text-center">Mes transactions</h3>
    <div class="container d-flex justify-content-end mb-3 col-md-12">
        <a role="button" class="btn btn-outline-success" href="transaction/create">Acheter une cryptomonnaie</a>
    </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Valeur actuelle</th>
                    <th scope="col">Prix d'achat</th>
                    <th scope="col">Date d'achat</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($transactionID as $trans)
                    {{print_r($trans)}}
                    <tr>

                       {{-- <td>{{$currencysDB[$CyrrencyName]->currency_name}}</td>
                        <td>{{$response->$ApiName->EUR}}&nbsp;€</td>
                        <td>{{$trans->expense_amount}}&nbsp;€</td>
                        <td>{{$trans->date_of_purchase}}</td>
                        @if ($trans->soldes == 0)
                            <td><a class="btn btn-outline-primary" href="">Vendre</a></td>
                        @else
                            <td><button type="button" class="btn btn-secondary" disabled>Vendu</button></td>
                        @endif
                        <td><button type="button" class="btn btn-secondary">Acheter</button></td>--}}
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

        <p class="text-muted">vous n'avez pas encore de cryptomonnaie ...</p>

@endsection
