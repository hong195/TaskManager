<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameCellColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cells', function (Blueprint $table) {
            $table->renameColumn('plan_approved_at', 'visualisation_date');
            $table->renameColumn('fact_approved_at', 'fact_start_date');
            $table->renameColumn('plan_finished_at', 'plan_deadline');
            $table->renameColumn('fact_finished_at', 'fact_deadline');
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
            $table->renameColumn('visualisation_date', 'visualisation_date');
            $table->renameColumn('fact_start_date', 'fact_approved_at');
            $table->renameColumn('plan_deadline', 'plan_finished_at');
            $table->renameColumn('fact_deadline', 'fact_finished_at');
        });
    }
}
