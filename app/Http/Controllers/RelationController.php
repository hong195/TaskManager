<?php

namespace App\Http\Controllers;

use App\Block;
use App\Cell;
use App\File;
use App\Unit;
use Illuminate\Http\Request;

class RelationController extends Controller
{

    public function unitRelation(Unit $unit)
    {
//        return view('relation.unit_department', ['departments' => $unit->departments]);
    }

    public function ajaxblocks(Request $request)
    {
//        return view('ajax', ['blocks' => Block::where('dep_id', $request->id)->get()]);
    }

    public function getDataBySection(Request $request)
    {
        $result = File::query()
            ->where('section_id', $request->sectionId)
            ->where('bu_id', $request->unitId)
            ->first();
        return view('ajax.photobooth', ['file' => $result]);
    }

    public function ajaxphotobooth()
    {
        return view('ajax.photobooth');
    }

    public function depRelation(Department $department)
    {
//        return view('relation.department_blocks', ['blocks' => $department->blocks]);
    }

    public function blockRelation(Block $block)
    {
        return view('relation.block_cells', ['cells' => $block->cells]);
    }

    public function cellRelation(Cell $cell)
    {
        return view('relation.cell_steps', ['steps' => $cell->steps]);
    }
}
