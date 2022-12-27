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
        Schema::create('alacartorders', function (Blueprint $table) {
            $table->id();
            $table->longText('trxId')->nullable();
            $table->longText('productId')->nullable();
            $table->longText('productName')->nullable();
            $table->longText('productImg')->nullable();
            $table->longText('productPrice')->nullable();
            $table->longText('qty')->nullable();
            $table->longText('addonprice')->nullable();
            $table->longText('addonName')->nullable();
            
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
        Schema::dropIfExists('alacartorders');
    }
};