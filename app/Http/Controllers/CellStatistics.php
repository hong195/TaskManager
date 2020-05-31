<?php

namespace App\Http\Controllers;

use App\Http\Contracts\GanttAnalitycsContract;
use App\Traits\DateTrait;

class CellStatistics extends Controller implements GanttAnalitycsContract
{
    use DateTrait;

    const PLAN_KEY = 'plan';
    const FACT_KEY = 'fact';

    public function getGanttData(iterable $cells) {
        $cellsData = [];

        foreach ($cells as $key => $cell) {

            $cellInfo =  [
                'id' => $cell->id,
                'name' => $cell->name,
                'plan' => [
                    'label' => __('cells.' . self::PLAN_KEY),
                    'start' => $this->formatDate($cell->created_at),
                    'end' =>  $this->formatDate($cell->deadline)
                ]
            ];

            if ($cell->status === 'complete') {
                $cellInfo['fact'] = [
                    'label' => __('cells.' . self::FACT_KEY),
                    'start' => $this->formatDate($cell->verified_date),
                    'end' => $this->formatDate($cell->updated_at),
                ];
            }

            $cellsData[] = $cellInfo;
        }

        return $cellsData;
    }

}
