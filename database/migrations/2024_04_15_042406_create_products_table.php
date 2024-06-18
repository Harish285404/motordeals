<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
             $table->string('user_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('brand_id')->nullable();
            $table->string('asking_price')->nullable();
            $table->string('year')->nullable();
            $table->string('type')->nullable();
            $table->string('sell_type')->nullable();
            $table->longText('add_title')->nullable();    
            $table->longText('description')->nullable();   
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_number')->nullable();   
            $table->string('image')->nullable();
             $table->string('ad_type')->nullable();
            $table->string('sold_date')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('products');
    }
}
