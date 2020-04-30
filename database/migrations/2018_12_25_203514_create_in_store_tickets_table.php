<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInStoreTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_store_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id');
            $table->string('device_type');
            $table->integer('problem_id');
            $table->string('problem_name');
            $table->float('our_cost',array(10,2));
            $table->float('retail_price',array(10,2));
            $table->string('password');
            $table->string('type_n_color');
            $table->string('carrier');
            $table->string('imei');
            $table->string('how_did_you_hear_about_us');
            $table->string('isdropoff');
            $table->string('tested_before_by');
            $table->string('tested_after_by');
            $table->string('tech_notes');
            $table->string('ticket_json');
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
        Schema::dropIfExists('in_store_tickets');
    }
}
