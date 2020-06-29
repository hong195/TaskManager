<?php

namespace App\Http\Controllers;

use App\Enums\CellStatus;
use App\Unit;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PrimaryUnitAnalyticController extends AbstractUnitAnalyticController
{
    private $duplicates;

    public function __construct(Unit $unit)
    {
        parent::__construct($unit);
        $this->duplicates = $this->filterDuplicates($this->getDuplicateTasks());
    }

    /**
     * @return int
     */
    public function getAcceptedTasks() : int
    {
        return $this->getDuplicates()->sum(function ($tasks) {
            $tasks = collect($tasks);
            $total = $tasks->sum(function ($task) {
                return isset($task->visualisation_date) ? 1 : 0;
            });

            return $total === $tasks->count() ? 1 : 0;
        });
    }

    /**
     * @return int
     */
    public function getPlannedTasks() : int
    {
        return $this->getDuplicates()->sum(function ($tasks) {
            $tasks = collect($tasks);
            $total = $tasks->sum(function ($task) {
                return isset($task->plan_deadline) ? 1 : 0;
            });

            return $total === $tasks->count() ? 1 : 0;
        });
    }

    /**
     * @return int
     */
    public function getCompletedTasks() : int
    {
        return $this->getDuplicates()->sum(function ($tasks) {
            $tasks = collect($tasks);
            $total = $tasks->sum(function ($task) {
                return $task->status === CellStatus::COMPLETE ? 1 : 0;
            });

            return $total === $tasks->count() ? 1 : 0;
        });
    }

    /**
     * @return int
     */
    public function getInProgressTasks() : int
    {
        return $this->getDuplicates()->sum(function ($tasks) {
            $tasks = collect($tasks);

            $total = $tasks->sum(function ($task) {
                return $task->status === CellStatus::IN_PROGRESS ? 1 : 0;
            });

            return $total === $tasks->count() ? 1 : 0;
        });
    }

    /**
     * get all cells with name duplicate names
     * @return \Illuminate\Support\Collection
     */
    private function getDuplicateTasks()
    {
        $subQuery = DB::table('cells')
            ->select('name')
            ->groupBy(['name'])
            ->havingRaw('COUNT(name) > 1');

        return DB::table('cells')
            ->select('*')
            ->join(
                DB::raw("({$subQuery->toSql()}) dup"), function ($join) {
                $join->on('cells.' . 'name', '=', 'dup.' . 'name');
            })
            ->get();
    }

    /**
     * format duplicates, remove primary unit cells
     * @param $duplicates
     * @return Collection
     */
    private function filterDuplicates($duplicates)
    {
        $formattedData = $duplicates->groupBy('name');
        $formattedData->each(function ($duplicates, $key) use ($formattedData) {
            // get duplicates ids
            $ids = $duplicates->map(function ($duplicate) {
                return $duplicate->block_id;
            })->intersect($this->getIncludedUnitBlocksIds());
            // remove if duplicates block_id not in  getIncludedUnitBlocksIds(),
            if (!$ids->count()) {
                $formattedData->forget($key);
            } else {
                $ids->each(function ($id, $key2) use ($duplicates) {
                    $duplicates->forget($key2);
                });
            }

        });

        return $formattedData;
    }

    /**
     * @return Collection
     */
    public function getDuplicates(): Collection
    {
        return $this->duplicates;
    }
}
