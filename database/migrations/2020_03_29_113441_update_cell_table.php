<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cells', function (Blueprint $table) {
            $table->timestamp('deadline')->default(\DB::raw('CURRENT_TIMESTAMP'))->after('name');

            $table->enum('status', ['complete', 'incomplete', 'missed'])
                ->default('incomplete')
                ->after('deadline');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cells', function (Blueprint $table) {
            $table->dropColumn('deadline');
            $table->dropColumn('status');
        });
    }
}
