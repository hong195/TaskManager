<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Support\Collection;

abstract class AbstractUnitAnalyticController extends Controller
{
    protected $unit;

    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
    }

    /**
     * @return int
     */
    public function getTotalCount() : int{
        return $this->unit->cells->count();
    }

    /**
     * @return int
     */
    abstract public function getAcceptedTasks() : int;

    /**
     * @return int
     */
    abstract public function getPlannedTasks() : int;

    /**
     * @return int
     */
    abstract public function getCompletedTasks() : int;

    /**
     * @return int
     */
    abstract public function getInProgressTasks() : int;

    /**
     * @return array
     */
    public function getAllData() : array
    {
        return [
            'total' => $this->getTotalCount(),
            'accepted' => $this->getAcceptedTasks(),
            'planned' => $this->getPlannedTasks(),
            'in_progress' => $this->getInProgressTasks(),
            'completed' => $this->getCompletedTasks()
        ];
    }
    /**
     * @return Collection
     */
    protected function getIncludedUnitBlocksIds() : Collection
    {
        return $this->unit->blocks->map(function ($block) {
            return $block->id;
        });
    }
}
