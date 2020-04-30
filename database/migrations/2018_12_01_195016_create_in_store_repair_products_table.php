<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInStoreRepairProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_store_repair_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id');
            $table->string('device_name');            
            $table->integer('model_id');
            $table->string('model_name');
            $table->integer('problem_id');
            $table->string('problem_name');
            $table->string('barcode');
            $table->string('name');
            $table->float('price');
            $table->float('cost');
            $table->integer('quantity');
            $table->text('description');
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
        Schema::dropIfExists('in_store_repair_products');
    }
}
