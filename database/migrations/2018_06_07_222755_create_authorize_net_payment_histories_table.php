<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizeNetPaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorize_net_payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->nullable()->default(0);
            $table->string('card_number')->nullable()->default(0);
            $table->string('card_holder_name')->nullable()->default(0);
            $table->string('card_expire_date')->nullable()->default(0);
            $table->string('card_cvc')->nullable()->default(0);

            $table->string('authCode')->nullable()->default(0);
            $table->string('transactionID')->nullable()->default(0);
            $table->string('CardType')->nullable()->default(0);
            $table->string('transactionHash')->nullable()->default(0);
            $table->string('message')->nullable()->default('Successful');

            $table->integer('store_id')->default(0);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
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
        Schema::dropIfExists('authorize_net_payment_histories');
    }
}
