<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('lead_id');
            $table->integer('quotation_id');
            $table->integer('good_type_id');
            $table->string('discharge_rate');
            $table->string('port_stay');
            $table->string('shipping_type');
            $table->string('description');
            $table->string('package');
            $table->string('weight');
            $table->string('total_package');
            $table->text('shipper');
            $table->text('notifying_address');
            $table->text('remarks');
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
        Schema::dropIfExists('cargos');
    }
}
