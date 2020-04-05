<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropForeign(['bu_id']);
            $table->dropForeign(['cell_id']);
            $table->dropForeign(['section_id']);
            $table->dropForeign(['term_id']);
            $table->dropForeign(['block_id']);

            $table->dropColumn(['bu_id', 'cell_id', 'section_id', 'term_id', 'block_id']);
            $table->integer('filable_id')->after('name');
            $table->string('filable_type')->after('filable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('files', function (Blueprint $table) {
            $table->dropColumn(['filable_id', 'filable_type']);
        });
    }
}
