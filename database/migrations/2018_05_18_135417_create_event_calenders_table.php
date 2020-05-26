<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventCalendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_calenders', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('event_name');
            $table->string('event_url');
            $table->date('event_start_date');
            $table->date('event_start_time');
            $table->date('event_end_date');
            $table->date('event_end_time');

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
        Schema::dropIfExists('event_calenders');
    }
}
