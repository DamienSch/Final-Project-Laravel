<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CryptomoneysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $table = 'cryptomoneys';@

    public function run()
    {
        DB::table($this->table)->insert([
            'currency_name' => 'Bitcoin',
            'API_id' => 'BTC',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table($this->table)->insert([
            'currency_name' => 'Ethereum',
            'API_id' => 'ETH',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table($this->table)->insert([
            'currency_name' => 'Ripple',
            'API_id' => 'XRP',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table($this->table)->insert([
            'currency_name' => 'Bitcoin Cash',
            'API_id' => 'BCH',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table($this->table)->insert([
            'currency_name' => 'Cardano',
            'API_id' => 'ADA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table($this->table)->insert([
            'currency_name' => 'Litecoin',
            'API_id' => 'LTC',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table($this->table)->insert([
            'currency_name' => 'NEM',
            'API_id' => 'XEM',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table($this->table)->insert([
            'currency_name' => 'Stellar',
            'API_id' => 'XLM',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table($this->table)->insert([
            'currency_name' => 'IOTA',
            'API_id' => 'MIOTA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table($this->table)->insert([
            'currency_name' => 'Dash',
            'API_id' => 'DASH',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
