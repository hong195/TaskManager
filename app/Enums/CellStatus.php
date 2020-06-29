<?php


namespace App\Enums;


class CellStatus
{
    CONST INCOMPLETE = 'incomplete';
    CONST COMPLETE = 'complete';
    CONST IN_PROGRESS = 'in_progress';
    CONST NOT_RELEVANT = 'not_relevant';

    static public function cellStatuses() {
        return [self::INCOMPLETE, self::COMPLETE, self::IN_PROGRESS, self::NOT_RELEVANT];
    }
}
