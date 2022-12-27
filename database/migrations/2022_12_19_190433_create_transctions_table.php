<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transctions', function (Blueprint $table) {
            $table->id();
            $table->longText('invoiceno')->nullable();
            $table->longText('trxdate')->nullable();
            $table->longText('subtotalamt')->nullable();
            $table->longText('discountamt')->nullable();
            $table->longText('gstamt')->nullable();
            $table->longText('deliveryamt')->nullable();
            $table->longText('finalamt')->nullable();
            $table->longText('paymenId')->nullable();
            $table->longText('trxFor')->nullable();
            $table->longText('userId')->nullable();
            $table->longText('address')->nullable();
            $table->longText('landmark')->nullable();
            $table->longText('pincode')->nullable();
            $table->longText('area')->nullable();
            $table->longText('city')->nullable();
            $table->longText('cpname')->nullable();
            $table->longText('cpno')->nullable();
            $table->longText('deliverystatus')->nullable();
            $table->longText('trxStatus')->nullable();
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
        Schema::dropIfExists('transctions');
    }
};
