<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotation_services', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id');
            $table->integer('tariff_id');
            $table->text('description');
            $table->string('grt_loa');
            $table->string('rate');
            $table->string('units');
            $table->string('tax');
            $table->string('total');
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
        Schema::dropIfExists('quotation_services');
    }
}
