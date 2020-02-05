<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
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
        $getApiBody = json_decode($this->getEuroCurrencyPrix(), true);
        $response = $getApiBody;
        foreach ($this->API_DB_ids as $val) {
            $cryptoIds[$val->API_id] = $val->currency_name;
        }
        return view('pages.crypto_moneys', compact('response','cryptoIds'));
    }
    public function bitcoin_history(Request $request)
    {
        //echo($request->currency);
        $getApiBody = json_decode($this->getCurrencyPrixHistory($request->currency));
        $response = $getApiBody->Data->Data;
        return view('pages.crypto_money_history', compact('response'));
    }
    public function users_gestion()
    {
        return view('pages.users_gestion');
    }
    // API Calls
    public function getEuroCurrencyPrix()
    {
        $client = new \GuzzleHttp\Client();
        $this->API_DB_ids = DB::table('cryptomoneys')->select('currency_name','API_id')->get();
        foreach ($this->API_DB_ids as $val) {
            $All_API_DB_ids[] = $val->API_id;
        }
        $API_ids = implode(',', $All_API_DB_ids);
        $response = $client->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms='.$API_ids.'&tsyms=EUR');
        return $response->getBody();
    }
    public function getCurrencyPrixHistory($currency)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://min-api.cryptocompare.com/data/v2/histoday?fsym='.$currency.'&tsym=EUR&limit=30');
        return $response->getBody();
    }
}
