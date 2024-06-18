<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_payments', function (Blueprint $table) {
            $table->id();
            $table->string('created_date')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_reference')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('invoice_display_value')->nullable();
            $table->integer('invoice_id')->nullable();
            $table->string('invoice_reference')->nullable();
            $table->string('invoice_status')->nullable();
            $table->string('invoice_value')->nullable();
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
        Schema::dropIfExists('car_payments');
    }
}
