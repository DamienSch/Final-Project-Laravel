<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transactions')->insert([
            'crypto_id' => '1',
            'user_id' => '1',
            'purchase_quantity' => '1',
            'expense_amount' => '1',
            'sale_amount' => '1',
            'currency_value' => '1',
            'soldes' => '1',
            'date_of_purchase' => Carbon::now(),
            'date_of_sale' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
