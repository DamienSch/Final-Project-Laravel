<?php

namespace App\Http\Controllers;

use App\Cryptomoney;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencys = Cryptomoney::all();
        $callAPI = new \GuzzleHttp\Client();
        $response = json_decode($callAPI->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,BCH,ADA,LTC,XEM,XLM,MIOTA,DASH&tsyms=EUR')->getBody());
        $currencysDB = DB::table('cryptomoneys')->select('id','API_id','currency_name')->get();
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(5);
        return view('transactions.index',compact('transactions','currencys','currencysDB','response'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $callAPI = new \GuzzleHttp\Client();
        $user = Auth::user();
        $response = json_decode($callAPI->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC&tsyms=EUR')->getBody());
        return view('transactions.create', compact('response', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
        ]);
        $transactions = new Transaction;
        $transactions->user_id = $request->input('user_id');
        $transactions->crypto_id = $request->input('crypto_id');
        $transactions->purchase_quantity = $request->input('purchase_quantity');
        $transactions->expense_amount = $request->input('expense_amount');
        $transactions->sale_amount = $request->input('sale_amount');
        $transactions->currency_value = $request->input('currency_value');
        $transactions->soldes = $request->input('soldes');
        $transactions->date_of_purchase = $request->input('date_of_purchase');
        $transactions->save();
        return redirect('/home')->with('success', 'Votre achat a été effectué avec succès');
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
