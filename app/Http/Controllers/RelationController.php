<?php

namespace App\Http\Controllers;

use App\Block;
use App\Cell;
use App\Department;
use App\Enums\CellStatus;
use App\File;
use App\Section;
use App\Unit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RelationController extends Controller
{

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
        $unit = Unit::where('id', $request->unitId)->first();
        $section = Section::where('id', $request->sectionId)->first();

        return view('ajax.photobooth', [
            'file' => $section->file,
            'section_id' => $request->sectionId,
            'unit_id' => $request->unitId,
            'unit' => $unit
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
        $cell_statuses = CellStatus::cellStatuses();

        return view('relation.block_cells', compact('block', 'department', 'unit', 'active_block', 'cell_statuses'));
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

    public function test()
    {
        $HRDeps = Department::where('name', 'like', 'логистики%')->pluck('id')->toArray();
        dd(array_values($HRDeps));
    }

    protected function getHRIds()
    {
        return [1, 9, 17, 25, 33, 41, 49];
    }

    protected function getFinancialIds()
    {
        return [2, 10, 18, 26, 34, 42, 50];
    }

    protected function getMarketingIds()
    {
        return [3, 11, 19, 27, 35, 43, 51];
    }

    protected function getItIds()
    {
        return [4, 12, 20, 28, 36, 44];
    }

    protected function getLawIds()
    {
        return [5, 13, 21, 29, 37, 45, 53];
    }

    protected function getPRIds()
    {
        return [ 6, 14, 22, 30, 38, 46, 54];
    }
    protected function getLogistics($job)
    {
        return [7, 15, 23, 31, 39, 47, 55];
    }

    protected function getCatManIds()
    {
        return [ 8, 16, 24, 32, 40, 48, 56];
    }
}
