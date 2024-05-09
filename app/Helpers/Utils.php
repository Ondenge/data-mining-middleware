<?php

namespace App\Helpers;

use Carbon\Carbon;

class Utils
{
    public static function getKHISDates($startDate, $endDate)
    {
        $periods = [];
        $startPeriod = Carbon::parse($startDate);
        $endPeriod = Carbon::parse($endDate);

        if ($startPeriod->gt($endPeriod)) {
            $startPeriod = Carbon::parse($endDate)->startOfMonth();
            $endPeriod = Carbon::parse($startDate)->endOfMonth();
        } else {
            $startPeriod = Carbon::parse($startDate)->startOfMonth();
            $endPeriod = Carbon::parse($endDate)->endOfMonth();
        }

        $diff = $endPeriod->diffInMonths($startPeriod, true);

        for ($i = 0; $i <= $diff; $i++) {
            $d = $startPeriod->copy()->addMonths($i);
            $periods[] = $d->format("Ym");
        }

        return $periods;
    }
}
