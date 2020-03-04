<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('crypto_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('crypto_id')->references('id')->on('cryptomoneys');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('purchase_quantity');
            $table->string('expense_amount');
            $table->string('sale_amount');
            $table->string('currency_value');
            $table->boolean('soldes');
            $table->date('date_of_purchase')->nullable();
            $table->date('date_of_sale')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('transactions');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
