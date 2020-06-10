<?php

namespace App\Http\Controllers;

use App\Cell;
use App\Enums\CellStatus;
use Illuminate\Http\Request;

class CellRelationController extends Controller
{
    public function steps(Cell $cell)
    {
        $block = $cell->block->load('cells.steps');
        $department = $cell->department();
        $unit = $cell->unit();
        $cell_statuses = CellStatus::cellStatuses();
        $active_cell = $cell->id;

        return view('relation.cell_steps',
            compact('cell', 'block', 'department', 'unit', 'cell_statuses', 'active_cell')
        );
    }
}
