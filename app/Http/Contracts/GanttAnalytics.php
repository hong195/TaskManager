<?php


namespace App\Http\Contracts;


use App\Cell;

interface GanttAnalytics
{
    public function getStatistic(iterable  $cells) ;
}
