<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Traits\Solde;



class HomeController extends Controller
{
    use Solde;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // Pages
    private $API_DB_ids;
    public function index()
    {
        return view('pages.home', compact('response'));
    }

    public function crypto_moneys()
    {
        $moneyAccount = $this->moneyAccount();
        $getApiBody = json_decode($this->getEuroCurrencyPrix(), true);
        $response = $getApiBody;
        // get all currency api id
        foreach ($this->API_DB_ids as $currency_api_id) {
            $cryptoIds[$currency_api_id->API_id] = $currency_api_id->currency_name;
        }
        return view('cryptomoneys.crypto_moneys', compact('response','cryptoIds','moneyAccount'));
    }
    public function currency_history(Request $request)
    {
        $moneyAccount = $this->moneyAccount();
        $getApiBody = json_decode($this->getCurrencyPrixHistory($request->currency));
        $response = $getApiBody->Data->Data;
        // find currency name from currency api id
        foreach($response as $item) {
            $currency_prices[] = $item->close;
            $dates[] = date('d-m-Y',$item->time);
        }
        // select currency name form currency api id
        $currency_api_id = DB::table('cryptomoneys')->select('currency_name')->where('API_id', '=', $request->currency)->get();
        return view('cryptomoneys.crypto_money_history', compact('response','currency_prices','dates','currency_api_id','moneyAccount'));
    }
    // API Calls
    public function getEuroCurrencyPrix()
    {
        $client = new \GuzzleHttp\Client();
        // select all currency api id
        $this->API_DB_ids = DB::table('cryptomoneys')->select('currency_name','API_id')->get();
        foreach ($this->API_DB_ids as $API_currency_id) {
            $All_API_DB_ids[] = $API_currency_id->API_id;
        }
        // separate currency api id
        $API_ids = implode(',', $All_API_DB_ids);
        // change url with currency api id parameter
        $response = $client->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms='.$API_ids.'&tsyms=EUR');
        return $response->getBody();
    }
    public function getCurrencyPrixHistory($currency)
    {
        $client = new \GuzzleHttp\Client();
        // change url with currency currency parameter
        $response = $client->request('GET', 'https://min-api.cryptocompare.com/data/v2/histoday?fsym='.$currency.'&tsym=EUR&limit=30');
        return $response->getBody();
    }
}
