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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('id');
             
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('Transactions')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('Items')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->integer('qty');
            $table->integer('subtotal');

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
        Schema::dropIfExists('transaction_details');
    }
};
