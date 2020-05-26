<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHigherCashierSaleSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('higher_cashier_sale_summaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cashier_id');
            $table->string('cashier_name');
            $table->float('invoice_total',array(10,2));
            $table->integer('store_id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('higher_cashier_sale_summaries');
    }
}
