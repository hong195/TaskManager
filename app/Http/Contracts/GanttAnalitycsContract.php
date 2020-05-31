<?php


namespace App\Http\Contracts;


use App\Cell;

interface GanttAnalitycsContract
{
    public function getGanttData(iterable  $cells) ;
}
