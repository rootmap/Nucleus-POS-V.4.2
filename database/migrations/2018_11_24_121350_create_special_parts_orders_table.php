<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialPartsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_parts_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id');
            $table->enum('ticket_payment_status',array('Unpaid','Partial','Paid','Cancel'));
            $table->string('description')->nullable();
            $table->string('part_url');
            $table->string('quantity');
            $table->float('cost_price');
            $table->float('sold_price');
            $table->integer('texable');
            $table->enum('texable_status',array('Yes','No'));
            $table->string('trackingnum')->nullable();
            $table->text('notes')->nullable();
            $table->date('ordered')->nullable();
            $table->date('received')->nullable();
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
        Schema::dropIfExists('special_parts_orders');
    }
}
