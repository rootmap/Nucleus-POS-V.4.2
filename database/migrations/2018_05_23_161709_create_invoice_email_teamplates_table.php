<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceEmailTeamplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_email_teamplates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name');
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->string('terms_title');
            $table->string('terms_text');
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
        Schema::dropIfExists('invoice_email_teamplates');
    }
}
