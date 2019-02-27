<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConsgneeDetailsToCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargos', function (Blueprint $table) {
            $table->string('consignee_name')->default('none');
            $table->string('consignee_address')->default('none');
            $table->string('consignee_email')->default('none');
            $table->string('consignee_telephone')->default('none');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cargos', function (Blueprint $table) {
            $table->dropColumn('consignee_name');
            $table->dropColumn('consignee_address');
            $table->dropColumn('consignee_email');
            $table->dropColumn('consignee_telephone');
        });
    }
}
