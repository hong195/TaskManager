<?php

namespace App\Http\Controllers;

use App\Department;
use App\Enums\CellStatus;
use App\Http\Contracts\CellAnalytic;
use App\Unit;
use Carbon\CarbonPeriod;

//use App\Http\Contracts\CellAnalytics;

class MonthCellAnalyticsController extends Controller implements CellAnalytic
{
    /**
     * define the year
     * @var int
     */
    protected $year;

    /**
     * the period of analytic
     * @var string
     */
    private $period = '1 month';

    /**
     * first month index
     * @var int
     */
    private $fromMonth = 1;

    /**
     * the last month index
     * @var int
     */
    private $toMonth = 12;

    /**
     * describe the inner structure of block analytic
     * @var int[]
     */
    private $template = [
        'work_in_plan' => 0,
        'work_in_fact' => 0,
        'finish_in_plan' => 0,
        'finish_in_fact' => 0,
    ];

    /**
     * describe the structure of department analytic
     * @var array
     */
    protected $departmentTemplate = [];

    /**
     * MonthCellAnalyticsController constructor.
     * @param int $year
     */
    public function __construct(int $year)
    {
        $this->year = $year;

        $this->generateUnitTemplate();
    }

    /**
     * View that`s holds all Unit analytics
     * @param Unit $unit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function analytics(Unit $unit)
    {
        $unit = $unit->load('departments.blocks.cells');

        return view('units.analytics', [
            'unit' => $unit,
            'template' => $this->template,
            'unitsAnalytics' => $this->getByUnit($unit)
        ]);
    }

    /**
     * @return void
     */
    private function generateUnitTemplate()
    {
        $period = CarbonPeriod::create(
            $this->year . '-' . $this->fromMonth,
            $this->period,
            $this->year . '-' . $this->toMonth
        );

        foreach ($period as $dt) {
            $this->departmentTemplate[$dt->locale('en')->shortMonthName] = $this->template;
        }
    }

    /**
     * Collect cell statistics by department
     * @param Unit $unit
     * @return array
     */
    public function getByUnit(Unit $unit)
    {
        $unitsAnalytics = [];

        foreach ($unit->departments as $department) {
            $unitsAnalytics[$department->name] = $this->getByDepartment($department);
        }

        return $unitsAnalytics;
    }

    /**
     * Collect cell statistics by department
     * @param Department $department
     * @return array
     */
    public function getByDepartment(Department $department)
    {
        $departmentAnalytic = $this->departmentTemplate;

        foreach ($department->blocks as $block) {
            foreach ($block->cells as $cell) {

                $visualisationDate = $cell->visualisation_date;
                $planDeadlineDate = $cell->plan_deadline;
                $factStartedDate = $cell->fact_start_date;
                $factDeadlineDate = $cell->fact_deadline;

                if ($visualisationDate && $this->year === $visualisationDate->year) {
                    ++$departmentAnalytic[$visualisationDate->locale('en')->shortMonthName]['work_in_plan'];
                }
                if ($factStartedDate && $this->year === $factStartedDate->year
                    && $cell->status === CellStatus::IN_PROGRESS) {
                    ++$departmentAnalytic[$factStartedDate->locale('en')->shortMonthName]['work_in_fact'];
                }
                if ($planDeadlineDate && $this->year === $planDeadlineDate->year) {
                    ++$departmentAnalytic[$planDeadlineDate->locale('en')->shortMonthName]['finish_in_plan'];
                }
                if ($factDeadlineDate && $this->year === $factDeadlineDate->year
                    && $cell->status === CellStatus::COMPLETE) {
                    ++$departmentAnalytic[$factDeadlineDate->locale('en')->shortMonthName]['finish_in_fact'];
                }
            }
        }

        return $departmentAnalytic;
    }
}
