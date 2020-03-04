@extends('layouts.app')

@section('content')
    <h3 class="text-center">Mes transactions</h3>
    <div class="d-flex flex-row-reverse bd-highlight mb-3">
        <a href="{{ route('crypto_moneys')}}" type="button" class="btn btn-outline-success">Acheter une Cryptomonnaie</a>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" scope="col">Nom</th>
            <th class="text-center" scope="col">Quantitée</th>
            <th class="text-center" scope="col">Valeur actuelle</th>
            <th class="text-center" scope="col">Valeur investi</th>
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
                <td class="text-center">{{$trans->expense_amount}}&nbsp;€</td>
                <td class="text-center">{{$trans->currency_value}}&nbsp;€</td>
                @if($response->$crypto_id_api->EUR - $trans->currency_value >= 0)
                    <td class="text-center" style="color: green">{{round($response->$crypto_id_api->EUR - $trans->currency_value,2)}}&nbsp;€</td>
                @else
                    <td class="text-center" style="color: darkred">{{round($response->$crypto_id_api->EUR - $trans->currency_value,2)}}&nbsp;€</td>
                @endif
                <td class="text-center">{{$trans->date_of_purchase}}</td>
                @if ($trans->soldes == 0)
                    <!-- Button trigger modal -->
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sell{{$trans->id}}">Vendre</button>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="sell{{$trans->id}}" tabindex="-1" role="dialog" aria-labelledby="sell{{$trans->id}}Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="sell{{$trans->id}}Title">Vendre mes {{round($trans->purchase_quantity, 2)}} {{$currencysDB[$crypto_id]->currency_name}}&nbsp;?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Prix d'achat : {{$trans->currency_value}}&nbsp;€</p>
                                    <p>Valeur actuel : {{$response->$crypto_id_api->EUR}}&nbsp;€</p>
                                    @if($response->$crypto_id_api->EUR - $trans->currency_value >= 0)
                                        <p>Plus value : <span class="lead" style="color: green">{{round($response->$crypto_id_api->EUR - $trans->currency_value,2)}}&nbsp;€</span></p>
                                    @else
                                        <p>Plus value : <span class="lead" style="color: darkred">{{round($response->$crypto_id_api->EUR - $trans->currency_value,2)}}&nbsp;€</span></p>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    {!! Form::open(['action' => ['TransactionController@sellTransaction'],$trans->id, 'method' => 'post']) !!}

                                    {!! Form::submit('Confirmer la vente', ['class' => ' btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
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
            {{$transactionID->links()}}
        </div>
    </div>
    @if (@count($transactionID) < 1)
        <p class="text-muted">vous n'avez pas encore de cryptomonnaie ...</p>
    @endif
@endsection
