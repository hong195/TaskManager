<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Верифайд к факту. Дедлайн к плану

        Schema::table('cells', function (Blueprint $table) {

            $table->dropColumn(['deadline', 'verified_date']);

            $table->dateTime('plan_approved_at')
                ->after('status')
                ->nullable();

            $table->datetime('plan_finished_at')
                ->after('plan_approved_at')
                ->nullable();

            $table->datetime('fact_approved_at')
                ->after('plan_finished_at')
                ->nullable();

            $table->datetime('fact_finished_at')
                ->after('fact_approved_at')
                ->nullable();

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
            $table->dropColumn(['plan_approved_at', 'plan_finished_at', 'fact_approved_at', 'fact_finished_at']);

            $table->dateTime('verified_date')
                ->after('status')
                ->default(date(now()))
                ->nullable();

            $table->timestamp('deadline')->default(\DB::raw('CURRENT_TIMESTAMP'))->after('name');
        });
    }
}
