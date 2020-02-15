<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendSalesEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_sales_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->default(0);
            $table->string('email_address')->nullable();
            $table->string('bcc_email_address')->nullable();
            $table->enum('email_send_status',array('Not Send','Send','Failed To Send'))->default('Not Send');
            $table->string('note')->nullable();
            $table->integer('email_process_type')->default(1);
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
        Schema::dropIfExists('send_sales_emails');
    }
}
