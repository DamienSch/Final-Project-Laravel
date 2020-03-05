<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Traits\Solde;
use Auth;


class TransactionController extends Controller
{
    use Solde;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Get API data
    public function callApi() {
        $callAPI = new \GuzzleHttp\Client();
        return json_decode($callAPI->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,BCH,ADA,LTC,XEM,XLM,MIOTA,DASH&tsyms=EUR')->getBody());
    }
    // Get transactions
    public function index()
    {
        // Get money account
        $moneyAccount = $this->moneyAccount();
        // Get Api
        $response = $this->callApi();
        // Get currency Database
        $currencysDB = DB::table('cryptomoneys')->select('id','API_id','currency_name')->get();
        // Get user transaction Database
        $transactionID = DB::table('transactions')->orderBy('created_at', 'desc')->select('*')->where('user_id','=',Auth::id())->get();
        return view('transactions.index',compact('currencysDB','response','transactionID','moneyAccount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Buy a currency -> create a transaction
    public function create($id)
    {
        session(['currencyId' => $id]);
        // Get money account
        $moneyAccount = $this->moneyAccount();
        // Get Api
        $response = $this->callApi();
        // Get user
        $user = Auth::user();
        // Get trasaction id
        $transaction = Transaction::find($id);
        // Get currency database from transaction id
        $currencysDB = DB::table('cryptomoneys')->select('id','API_id','currency_name')->where('API_ID','=',$id)->get();
        return view('transactions.create', compact('response', 'user', 'currencysDB','transaction','moneyAccount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Store data from buying transaction
    public function store(Request $request )
    {
        // Get API
        $response = $this->callApi();
        // Get currency id to store currency price
        $id = $request->session()->get('currencyId');
        // Get currency database from currency id
        $currencysDB = DB::table('cryptomoneys')->select('id','API_id','currency_name')->where('API_ID','=',$id)->get();
        $this->validate($request , [
            'investisment' => 'required',
        ]);
        // store data in database
        $transactions = new Transaction;
        $transactions->user_id = Auth::id();
        $transactions->crypto_id = $currencysDB[0]->id;
        $transactions->purchase_quantity = $request->input('investisment') / $response->$id->EUR;
        $transactions->expense_amount = $request->input('investisment');
        $transactions->sale_amount = NULL;
        $transactions->currency_value = $response->$id->EUR;
        $transactions->soldes = 0;
        $transactions->date_of_purchase = Carbon::now();
        $transactions->save();
        return redirect('/home')->with('success', 'Votre achat a été effectué avec succès');
    }
    // Sell transactions
    public function sellTransaction(Request $request)
    {
        // Get API
        $response = $this->callApi();
        // Get transaction id
        $transactionid = $request->transId;
        // Get transaction database from transaction id
        $transactionsDB = DB::table('transactions')->select('*')->where('id','=',$transactionid)->get();
        // Get currency api names
        $cryptomoneysDB = DB::table('cryptomoneys')->select('API_id')->get();
        // Update Transaction for selling
        $transactions = Transaction::find($transactionid);
        // Get Database Id ex:('1')
        $cryptoCurrencyId = $transactionsDB[0]->crypto_id - 1;
        // Get APi Id ex:('BTC')
        $api = $cryptomoneysDB[$cryptoCurrencyId]->API_id;
        $transactions->user_id = Auth::user()->id;
        $transactions->crypto_id = $transactionsDB[0]->crypto_id;
        $transactions->purchase_quantity = $transactionsDB[0]->purchase_quantity;
        $transactions->expense_amount = $transactionsDB[0]->expense_amount;
        $transactions->sale_amount = $response->$api->EUR;
        $transactions->currency_value = $transactionsDB[0]->currency_value;
        $transactions->soldes = 1;
        $transactions->date_of_purchase = $transactionsDB[0]->date_of_purchase;
        $transactions->date_of_sale = Carbon::now();
        $transactions->save();
        return redirect('/home')->with('success', 'Votre vente a été effectué avec succès');
    }
}
