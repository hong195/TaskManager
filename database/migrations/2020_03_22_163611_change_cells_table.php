<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('cells', function (Blueprint $table) {
//            $table->dropForeign(['block_id']);
//            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
//        });
        Schema::table('steps', function (Blueprint $table) {
            $table->dropForeign(['cell_id']);
            $table->foreign('cell_id')->references('id')->on('cells')->onDelete('cascade');
        });

//        Schema::table('blocks', function (Blueprint $table){
//            //$table->dropColumn(['section_id']);
//            $table->unsignedBigInteger('department_id')->after('id');
//            $table->foreign('department_id')
//                ->references('id')
//                ->on('departments')
//                ->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cells', function (Blueprint $table) {
            //
        });
    }
}
