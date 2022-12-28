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
        Schema::create('subscriptionkts', function (Blueprint $table) {
            $table->id();
            $table->string('trxId');
            $table->string('subOdrId');
            $table->integer('userId');
            $table->string('productId');
            $table->string('productName');
            $table->string('productImage');
            $table->string('mealTime');
            $table->integer('mealPrice');
            $table->string('status');
            $table->timestamp('completedTime');
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
        Schema::dropIfExists('subscriptionkts');
    }
};
