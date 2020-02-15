<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInStoreRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('in_store_repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id');
            $table->string('device_name');
            $table->integer('model_id');
            $table->string('model_name');
            $table->integer('problem_id');
            $table->string('problem_name');
            $table->float('override_repair_price',array(10,2));
            $table->float('repair_price',array(10,2));
            $table->string('repair_password');
            $table->string('repair_imei');
            $table->string('repair_tested_before_by');
            $table->string('repair_tested_after_by');
            $table->string('repair_tech_notes');
            $table->string('repair_how_did_you_hear_about_us');
            $table->string('repair_start_time');
            $table->string('repair_end_time');
            $table->string('repair_salvage_part');
            $table->string('repair_json');
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
        Schema::dropIfExists('in_store_repairs');
    }
}
