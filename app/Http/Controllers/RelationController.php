<?php

namespace App\Http\Controllers;

use App\Block;
use App\Cell;
use App\Department;
use App\Enums\CellStatus;
use App\File;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RelationController extends Controller
{


    public function test()
    {
        $user = User::where('email', 'alexeyhong10@gmail.com')->first();
        $user->password = Hash::make('123');
        $user->save();

    }
    public function unitRelation(Unit $unit)
    {
        return view('relation.unit_department', ['unit' => $unit ?? []]);
    }

    public function ajaxblocks(Request $request)
    {
        return view('ajax', ['blocks' => Block::where('dep_id', $request->id)->get()]);
    }

    public function getDataBySection(Request $request)
    {
        $file = File::where('section_id', $request->sectionId)
            ->where('bu_id', $request->unitId)
            ->first();

        return view('ajax.photobooth', [
            'file' => $file,
            'section_id' => $request->sectionId,
            'unit_id' => $request->unitId
        ]);
    }

    public function ajaxphotobooth()
    {
        return view('ajax.photobooth');
    }

    public function depRelation(Department $department)
    {
        $unit = Unit::where('id', $department->bu_id)->first();
        $active_dep = $department->id;
        return view('relation.department_blocks',
            [
                'department' => $department, 'unit' => $unit, 'active_dep' => $active_dep
            ]);
    }

    public function blockRelation(Block $block)
    {
        $department = Department::where('id', $block->dep_id)->first();
        $unit = Unit::where('id', $department->bu_id)->first();
        $active_block = $block->id;

        return view('relation.block_cells', compact('block', 'department', 'unit', 'active_block'));
    }

    public function cellRelation(Cell $cell)
    {
        $block = Block::where('id', $cell->block_id)->first();
        $department = Department::where('id', $block->dep_id)->first();
        $unit = Unit::where('id', $department->bu_id)->first();
        $cell_statuses = CellStatus::cellStatuses();
        $active_cell = $cell->id;

        return view('relation.cell_steps',
               compact('cell', 'block', 'department', 'unit', 'cell_statuses', 'active_cell')
        );
    }
}
