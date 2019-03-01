<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCargoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargos', function (Blueprint $table) {
            $table->string('consignee_name');
            $table->string('consignee_address');
            $table->string('consignee_telephone');
            $table->string('consignee_email');
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
            $table->dropColumn('consignee_telephone');
            $table->dropColumn('consignee_email');
        });
    }
}
