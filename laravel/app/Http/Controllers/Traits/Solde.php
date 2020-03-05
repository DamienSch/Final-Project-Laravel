<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// Get Money value Account everywhere
trait Solde
{
    public function moneyAccount()
    {
        $moneyAccount = DB::table('transactions')->select('expense_amount')->where('soldes','=',0)->where('user_id', '=', Auth::id())->sum('expense_amount');
        return $moneyAccount;
    }
}
