<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->unsignedBigInteger('bu_id')->after('id');
            $table->foreign('bu_id')->on('units')->references('id')->onDelete('cascade');
        });

        Schema::dropIfExists('unit_section');
        Schema::dropIfExists('terms');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropForeign('bu_id');
            $table->dropColumn('bu_id');
        });
    }
}
