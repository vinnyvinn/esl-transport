<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quotation_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('approved_by')->nullable();
            $table->integer('invnum_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->boolean('in_quotation')->default(0);
            $table->integer('supplier_id')->unsigned();
            $table->datetime('po_date');
            $table->string('po_no');
            $table->string('input_currency');
            $table->string('status');
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
        Schema::dropIfExists('purchase_orders');
    }
}
