<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AnalyticController extends Controller
{
    const PRIMARY_UNIT_ID = 1;

    private $departmentAnalytic;

    /**
     * AnalyticController constructor.
     * @param $departmentAnalytic
     */
    public function __construct(MonthCellAnalyticsController $departmentAnalytic)
    {
        $this->departmentAnalytic = $departmentAnalytic;
    }
    /**
     * View that`s holds all Unit analytics
     * @param Unit $unit
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Unit $unit)
    {
        $unit = $unit->load('departments.blocks.cells');

        if ($unit->id === self::PRIMARY_UNIT_ID) {
            $totalAnalytic = [];

            $units = Unit::where('id', '!=',self::PRIMARY_UNIT_ID)->get();

            foreach ($units as $singleUnit) {
                $unitAnalytic = new UnitTotalAnalyticController($singleUnit);
                $totalAnalytic[$singleUnit->name] = $unitAnalytic->getAllData();
            }

            $primaryCompany = new PrimaryUnitAnalyticController($unit);
            $totalAnalytic[$unit->name] = $primaryCompany->getAllData();

        }

        return view('units.analytics', [
            'currentYear' => $this->departmentAnalytic->getYear(),
            'years' => $this->getAnalyticYears(),
            'unit' => $unit,
            'template' => $this->departmentAnalytic->getTemplate(),
            'unitsAnalytics' => $this->departmentAnalytic->getByUnit($unit),
            'totalAnalytics' => $totalAnalytic ?? []
        ]);
    }

    public function getAnalyticYears()
    {
        return [
            Carbon::parse(now())->year,
            Carbon::parse('+ 1year')->year
        ];
    }
}
