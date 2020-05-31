<?php

namespace App\Http\Controllers;

use App\Block;
use App\Department;
use App\Http\Contracts\GanttAnalitycsContract;
use App\Unit;
use Illuminate\Http\Request;

class CellGanttController extends Controller
{
    private $gantt;

    /**
     * RelationController constructor.
     * @param GanttAnalitycsContract $cellsGannt
     */

    public function __construct(GanttAnalitycsContract $gantt)
    {
        $this->gantt = $gantt;
    }

    public function ganttView(Unit $unit, $departmentId = null)
    {
        if (!$departmentId) {
            $department = $unit->departments->first();
        }else {
            $department = Department::findOrFail($departmentId);
        }

        return view('cells.gannt', compact('unit', 'department'));
    }

    public function getGanttAnalitic(Request $request) {

        $block = Block::findOrFail($request->blockId);
        $ganttData = $this->gantt->getGanttData($block->cells);

        return response()->json(compact('ganttData'));
    }
}
