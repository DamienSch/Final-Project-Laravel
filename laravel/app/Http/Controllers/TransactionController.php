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
    public function callApi() {
        $callAPI = new \GuzzleHttp\Client();
        return json_decode($callAPI->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,BCH,ADA,LTC,XEM,XLM,MIOTA,DASH&tsyms=EUR')->getBody());
    }
    public function index()
    {
        $response = $this->callApi();
        $currencys = Cryptomoney::all();
        $currencysDB = DB::table('cryptomoneys')->select('id','API_id','currency_name')->get();
        $transactionID = DB::table('transactions')->select('*')->where('user_id','=',Auth::id())->get();
        $user = Auth::user();
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(5);
        return view('transactions.index',compact('transactions','currencys','currencysDB','response', 'user','transactionID'));
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
        $id = $request->session()->get('currencyId');
        $currencysDB = DB::table('cryptomoneys')->select('id','API_id','currency_name')->where('API_ID','=',$id)->get();
        $this->validate($request , [
        ]);
        $transactions = new Transaction;
        $transactions->user_id = Auth::id();
        $transactions->crypto_id = $currencysDB[0]->id;
        $transactions->purchase_quantity = $request->input('purchase_quantity');
        $transactions->expense_amount = $request->input('expense_amount');
        $transactions->sale_amount = $request->input('sale_amount');
        $transactions->currency_value = $request->input('currency_value');
        $transactions->soldes = 0;
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
