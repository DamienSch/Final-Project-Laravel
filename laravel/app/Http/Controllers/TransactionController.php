<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Auth;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function callApi() {
        $callAPI = new \GuzzleHttp\Client();
        return json_decode($callAPI->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,BCH,ADA,LTC,XEM,XLM,MIOTA,DASH&tsyms=EUR')->getBody());
    }
    public function index()
    {
        $response = $this->callApi();
        $currencysDB = DB::table('cryptomoneys')->select('id','API_id','currency_name')->get();
        $transactionID = DB::table('transactions')->orderBy('created_at', 'desc')->select('*')->where('user_id','=',Auth::id())->paginate(5);
        return view('transactions.index',compact('currencysDB','response','transactionID'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {
        session(['currencyId' => $id]);
        $response = $this->callApi();
        $user = Auth::user();
        $transaction = Transaction::find($id);
        $currencysDB = DB::table('cryptomoneys')->select('id','API_id','currency_name')->where('API_ID','=',$id)->get();
        return view('transactions.create', compact('response', 'user', 'currencysDB','transaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
        $response = $this->callApi();
        $id = $request->session()->get('currencyId');
        $currencysDB = DB::table('cryptomoneys')->select('id','API_id','currency_name')->where('API_ID','=',$id)->get();
        $this->validate($request , [
        ]);
        $transactions = new Transaction;
        $transactions->user_id = Auth::id();
        $transactions->crypto_id = $currencysDB[0]->id;
        $transactions->purchase_quantity = $request->input('expense_amount') / $response->$id->EUR;
        $transactions->expense_amount = $request->input('expense_amount');
        $transactions->sale_amount = NULL;
        $transactions->currency_value = $response->$id->EUR;
        $transactions->soldes = 0;
        $transactions->date_of_purchase = Carbon::now();
        $transactions->save();
        return redirect('/home')->with('success', 'Votre achat a été effectué avec succès');
    }

    public function sellTransaction(Request $request )
    {
        $response = $this->callApi();
        $id = $request->session()->get('currencyId');
        $transactionid = 2;
        $transactionsDB = DB::table('transactions')->select('*')->where('user_id','=',Auth::user()->id)->get();
        $this->validate($request , [
        ]);
        $transactions = Transaction::find($transactionid);
        $transactions->user_id = Auth::id();
        $transactions->crypto_id = $transactionsDB[$transactionid]->id;
        $transactions->purchase_quantity = $transactionsDB[$transactionid]->purchase_quantity;
        $transactions->expense_amount = $transactionsDB[$transactionid]->expense_amount;
        $transactions->sale_amount = $response->$id->EUR;
        $transactions->currency_value = $transactionsDB[$transactionid]->currency_value;
        $transactions->soldes = 1;
        $transactions->date_of_purchase = $transactionsDB[$transactionid]->date_of_purchase;
        $transactions->date_of_sale = Carbon::now();
        $transactions->save();
        return redirect('/home')->with('success', 'Votre vente a été effectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        return view('transactions.show')->with('transaction',$transaction);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
