<?php

namespace App\Http\Controllers;

use App\Enums\CellStatus;
use App\Unit;

class UnitTotalAnalyticController extends AbstractUnitAnalyticController
{
    /**
     * @var
     */
    protected $unit;

    public function __construct(Unit $unit)
    {
        parent::__construct($unit);
    }

    /**
     * @return int
     */
    public function getInProgressTasks(): int
    {
        return $this->unit->cells->sum(function ($cell) {
            return $cell->status === CellStatus::IN_PROGRESS ? 1 : 0;
        });
    }

    /**
     * @return int
     */
    public function getAcceptedTasks() : int
    {
        return $this->unit->cells->sum(function ($cell) {
            return isset($cell->visualisation_date) ? 1 : 0;
        });
    }

    /**
     * @return int
     */
    public function getPlannedTasks() : int
    {
        return $this->unit->cells->sum(function ($cell) {
            return isset($cell->plan_deadline) ? 1 : 0;
        });
    }

    /**
     * @return int
     */
    public function getCompletedTasks() : int
    {
        return $this->unit->cells->sum(function ($cell) {
            return $cell->status === CellStatus::COMPLETE ? 1 : 0;
        });
    }
}
