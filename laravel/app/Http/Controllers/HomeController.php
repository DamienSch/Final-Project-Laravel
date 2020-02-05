<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



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
    public function index()
    {

        return view('pages.home', compact('response'));
    }
    public function crypto_moneys()
    {
        $getApiBody = json_decode($this->getEuroCurrencyPrix(), true);
        $response = $getApiBody;
        return view('pages.crypto_moneys', compact('response'));
    }
    public function bitcoin_history()
    {
        $getApiBody = json_decode($this->getCurrencyPrixHistory('BTC'));
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

        $response = $client->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH,XRP,BCH,ADA,XEM,XLM,MIOTA,DASH,LTC&tsyms=EUR');
        return $response->getBody();


    }
    public function getCurrencyPrixHistory($currency)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://min-api.cryptocompare.com/data/v2/histoday?fsym='.$currency.'&tsym=EUR&limit=30');
        return $response->getBody();
    }
}
