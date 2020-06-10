<?php


namespace App\Http\Contracts;

use App\Department;
use App\Unit;

interface CellAnalytic
{
    public function getByUnit(Unit $unit);

    public function getByDepartment(Department $department);
}
