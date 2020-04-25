<?php


namespace App\Enums;


class CellStatus
{
    public CONST INCOMPLETE = 'incomplete';
    public CONST COMPLETE = 'complete';
    public CONST IN_PROGRESS = 'in_progress';
    public CONST NOT_RELEVANT = 'not_relevant';

    static public function cellStatuses() {
        return [self::INCOMPLETE, self::COMPLETE, self::IN_PROGRESS, self::NOT_RELEVANT];
    }
}
