<?php


namespace App\Enums;


class CellStatus
{
    public CONST INCOMPLETE = 'incomplete';
    public CONST MISSED = 'missed';
    public CONST COMPLETE = 'complete';

    static public function cellStatuses() {
        return [self::COMPLETE,self::INCOMPLETE, self::MISSED];
    }
}
