<?php

namespace App\Http\Controllers;

use App\Block;
use App\Department;
use App\Enums\CellStatus;
use App\Http\Contracts\GanttAnalytics;
use App\Traits\DateTrait;
use App\Unit;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CellGanttController extends Controller implements GanttAnalytics
{
    use DateTrait;

    const PLAN_KEY = 'plan';
    const FACT_KEY = 'fact';

    /**
     * @param Collection[] $cells
     * @return array
     */

    public function getStatistic(iterable $cells): array
    {
        $cellsData = [];

        foreach ($cells as $key => $cell) {

            // The cell should not be in CellStatus::IN_PROGRESS status, otherwise users will not see the 'plan 'task
            // enough to have plan_deadline and visualisation_date datetime
            if ($cell->plan_deadline && $cell->visualisation_date) {
                $cellsData[] = $this->addTask(
                    $cell->name . ' - ' . __('cells.' . self::PLAN_KEY),
                    $cell->visualisation_date,
                    $cell->plan_deadline
                );
            }
            // status CellStatus::COMPLETE indicate that cell is fully completed, that`s why need to check complete status
            if ($cell->status === CellStatus::COMPLETE && $cell->fact_deadline && $cell->fact_start_date) {
                $cellsData[] = $this->addTask(
                    $cell->name . ' - ' . __('cells.' . self::FACT_KEY),
                    $cell->fact_start_date,
                    $cell->fact_deadline
                );
            }
        }

        return $cellsData;
    }

    /**
     * @param string $label
     * @param $startDate
     * @param $endDate
     * @return array
     */
    private function addTask(string $label, $startDate, $endDate)
    {
        return [
            'label' => $label,
            'start' => $this->formatDate($startDate),
            'end' => $this->formatDate($endDate)
        ];
    }

    /**
     * @param Unit $unit
     * @param Department|null $department
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ganttView(Unit $unit,Department $department = null)
    {
        if (!$department) {
            $department = $unit->departments->first();
        }
        return view('cells.gannt', compact('unit', 'department'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGanttAnalytic(Request $request)
    {
        $block = Block::findOrFail($request->blockId);
        $ganttData = $this->getStatistic($block->cells);

        return response()->json(compact('ganttData'));
    }
}


