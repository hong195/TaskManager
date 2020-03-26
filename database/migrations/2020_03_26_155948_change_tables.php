<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('blocks', function (Blueprint $table) {
//            $table->dropColumn('section_id');
//            $table->unsignedBigInteger('department_id');
//            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
//        });
//        Schema::table('cells', function (Blueprint $table) {
//            $table->dropForeign(['block_id']);
//            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
//        });
//        Schema::table('steps', function (Blueprint $table) {
//            $table->dropForeign(['cell_id']);
//            $table->foreign('cell_id')->references('id')->on('cells')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
}
