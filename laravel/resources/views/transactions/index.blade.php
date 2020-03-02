@extends('layouts.app')

@section('content')
    <h3 class="text-center">Mes transactions</h3>

    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" scope="col">Nom</th>
            <th class="text-center" scope="col">Quantitée</th>
            <th class="text-center" scope="col">Valeur actuelle</th>
            <th class="text-center" scope="col">Prix d'achat</th>
            <th class="text-center" scope="col">Plus-value</th>
            <th class="text-center" scope="col">Date d'achat</th>
            <th class="text-center" scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactionID as $trans)
            <?php
            $crypto_id = $trans->crypto_id - 1;
            $crypto_id_api = $currencysDB[$crypto_id]->API_id
            ?>
            <tr>
                <td class="text-center">{{$currencysDB[$crypto_id]->currency_name}}</td>
                <td class="text-center">{{round($trans->purchase_quantity, 2)}}&nbsp;{{$currencysDB[$crypto_id]->API_id}}</td>
                <td class="text-center">{{$response->$crypto_id_api->EUR}}&nbsp;€</td>
                <td class="text-center">{{$trans->sale_amount}}&nbsp;€</td>
                @if($response->$crypto_id_api->EUR - $trans->sale_amount >= 0)
                    <td class="text-center" style="color: green">{{round($response->$crypto_id_api->EUR - $trans->sale_amount,2)}}&nbsp;€</td>
                @else
                    <td class="text-center" style="color: darkred">{{round($response->$crypto_id_api->EUR - $trans->sale_amount,2)}}&nbsp;€</td>
                @endif
                <td class="text-center">{{$trans->date_of_purchase}}</td>
                @if ($trans->soldes == 0)
                    <td class="text-center"><a class="btn btn-outline-primary" href="">Vendre</a></td>
                @else
                    <td class="text-center"><button type="button" class="btn btn-secondary" disabled>Vendu</button></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- Pagination -->
    <div class="col-12">
        <div class="mx-auto d-flex pagination container justify-content-center">

        </div>
    </div>
    @if (@count($transactionID) < 1)
        <p class="text-muted">vous n'avez pas encore de cryptomonnaie ...</p>
    @endif
@endsection
