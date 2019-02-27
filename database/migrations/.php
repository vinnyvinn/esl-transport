<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCargosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cargos', function (Blueprint $table) {
            $table->string('start');
            $table->string('destination');
            $table->integer('cargo_type')->unsigned();
            $table->integer('cargo_quantity');
            $table->string('status')->default('pending');
            $table->integer('distance')->default(0);
            $table->integer('bl_number')->default(0);
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
            $table->dropColumn('start');
            $table->dropColumn('destination');
            $table->dropColumn('cargo_type');
            $table->dropColumn('cargo_quantity');
            $table->dropColumn('status');
            $table->dropColumn('distance');
            $table->dropColumn('bl_number');
        });
    }
}
