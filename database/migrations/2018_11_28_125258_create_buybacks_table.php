<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuybacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buybacks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->string('customer_name');
            $table->string('model');
            $table->string('carrier');
            $table->string('imei');
            $table->string('type_and_color');
            $table->string('memory');
            $table->enum('keep_this_on',array('Parts','Sale'));
            $table->string('condition')->nullable();
            $table->float('price');
            $table->integer('payment_method_id');
            $table->string('payment_method_name');
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
        Schema::dropIfExists('buybacks');
    }
}
