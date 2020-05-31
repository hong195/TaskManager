<?php


namespace App\Traits;


use Carbon\Carbon;

trait DateTrait
{
    public function formatDate($date, $format = 'Y-m-d') {
        return Carbon::parse($date)->format($format);
    }
}
