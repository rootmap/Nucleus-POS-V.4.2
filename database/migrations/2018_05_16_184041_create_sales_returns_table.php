<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_returns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->default('0');
            $table->integer('customer_id')->default('0');
            $table->string('customer_name')->default('Not Mention');
            $table->double('invoice_total',8,2)->default('0.00');
            $table->double('sales_return_amount',8,2)->default('0.00');
            $table->string('sales_return_note')->default('');
            $table->integer('store_id');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_returns');
    }
}
