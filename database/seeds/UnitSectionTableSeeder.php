<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allSectionId = \App\Section::all()->pluck('id');
        $allUnitsId = \App\Unit::all()->pluck('id');
        $database = DB::table('unit_section');
        foreach($allUnitsId as $oneUnitId){
            foreach($allSectionId as $oneSectionId){
                $database->insert([
                    'unit_id' => $oneUnitId,
                    'section_id' => $oneSectionId
                ]);
            }
        }
    }
}
