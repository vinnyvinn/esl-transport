<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVesselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lead_id');
            $table->string('name');
            $table->string('imo_number');
            $table->string('country');
            $table->string('call_sign');
            $table->string('loa');
            $table->string('grt');
            $table->string('consignee_good');
            $table->string('nrt');
            $table->string('dwt');
            $table->string('port');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessels');
    }
}
