<?php


namespace App\Traits;


use Carbon\Carbon;

trait DateTrait
{
    /**
     * get formatted date
     * @param mixed $dt
     * @param string $format
     * @return string
     */
    public function formatDate($dt, $format = 'Y-m-d') {

        /*convert date into Carbon if it`s not*/
        if (!($dt instanceof Carbon)) {
            $dt = Carbon::parse($dt);
        }
        return $dt->format($format);

    }
}
