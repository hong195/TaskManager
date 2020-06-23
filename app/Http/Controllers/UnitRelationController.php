<?php

namespace App\Http\Controllers;

use App\Block;
use App\Section;
use App\Unit;
use Illuminate\Http\Request;

class UnitRelationController extends Controller
{
    public function departments(Unit $unit)
    {
        $unit->load('departments.blocks');

        $departments = $unit->departments->sort(function ($a, $b) {
            return $a->order - $b->order;
        });

        return view('relation.unit_department', [
            'unit' => $unit,
            'departments' => $departments
        ]);
    }

    public function getDataBySection(Request $request)
    {
        $unit = Unit::where('id', $request->unitId)->first();
        $section = Section::where('id', $request->sectionId)->first();

        return view('ajax.photobooth', [
            'file' => $section->file,
            'section_id' => $request->sectionId,
            'unit_id' => $request->unitId,
            'unit' => $unit
        ]);
    }

    public function ajaxblocks(Request $request)
    {
        return view('ajax', ['blocks' => Block::where('dep_id', $request->id)->get()]);
    }

    public function ajaxphotobooth()
    {
        return view('ajax.photobooth');
    }
}
