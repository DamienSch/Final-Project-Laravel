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
        $getApiBody = json_decode($this->getApi(), true);
        print_r($getApiBody);
        $response = $getApiBody;
        return view('pages.home', compact('response'));
    }
    public function crypto_money()
    {
        $getApiBody = json_decode($this->getHistory('BTC'));
        $response = $getApiBody->Data->Data;
        return view('pages.crypto_money', compact('response'));
    }
    public function users_gestion()
    {
        return view('pages.users_gestion');
    }
    public function getApi()
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://min-api.cryptocompare.com/data/pricemulti?fsyms=BTC,ETH&tsyms=EUR');
        return $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
// un requete par currency
// toute mes currency a un instant t

        /*      // Send an asynchronous request.
              $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
              $promise = $client->sendAsync($request)->then(function ($response) {

              });

              $promise->wait();
          */    //return view('pages.home');

    }
    public function getHistory($currency)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://min-api.cryptocompare.com/data/v2/histoday?fsym='.$currency.'&tsym=EUR&limit=30');
        return $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
    }
}
