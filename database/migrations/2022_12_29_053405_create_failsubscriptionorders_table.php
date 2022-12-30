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
        Schema::create('failsubscriptionorders', function (Blueprint $table) {
            $table->id();
            $table->longText('trxId')->nullable();
            $table->longText('userId')->nullable();
            $table->longText('packageId')->nullable();
            $table->longText('totaldays')->nullable();
            $table->longText('totalmeal')->nullable();
            $table->longText('subscribedfor')->nullable();
            $table->longText('mealPrice')->nullable();
            $table->longText('startdate')->nullable();
            $table->longText('status')->nullable();
            
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
        Schema::dropIfExists('failsubscriptionorders');
    }
};
