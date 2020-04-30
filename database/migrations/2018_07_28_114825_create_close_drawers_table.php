<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCloseDrawersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('close_drawers', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('opeing_time')->nullable();
            $table->dateTime('closing_time')->nullable();
            $table->float('opeing_amount',array(10,2))->nullable()->default(0);
            $table->float('closing_amount',array(10,2))->nullable()->default(0);
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
        Schema::dropIfExists('close_drawers');
    }
}
