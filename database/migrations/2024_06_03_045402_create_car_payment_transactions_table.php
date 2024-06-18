<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarPaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('car_payment_id')->nullable();
            $table->string('authorization_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('customer_service_charge')->nullable();
            $table->string('due_value')->nullable();
            $table->string('error_code')->nullable();
            $table->string('paid_currency')->nullable();
            $table->string('paid_currency_value')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->string('track_id')->nullable();
            $table->string('transaction_date')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('transaction_status')->nullable();
            $table->string('transaction_value')->nullable();
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
        Schema::dropIfExists('car_payment_transactions');
    }
}
