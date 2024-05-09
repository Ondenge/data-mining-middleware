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

    public static function getEIDDates($startDate, $endDate)
    {
        $periods = [];
        $startPeriod = Carbon::parse($startDate)->startOfMonth();
        $endPeriod = Carbon::parse($endDate)->endOfMonth();

        $periods[] = $startPeriod->format("Y-m-d");
        $periods[] = $endPeriod->format("Y-m-d");

        return $periods;
    }

    public static function getDATIMDates($startDate, $endDate)
    {
        $periods = [];
        $startPeriod = Carbon::parse($startDate);
        $endPeriod = Carbon::parse($endDate);

        if ($startPeriod->gt($endPeriod)) {
            $startPeriod = Carbon::parse($endDate)->startOfQuarter();
            $endPeriod = Carbon::parse($startDate)->endOfQuarter();
        } else {
            $startPeriod = Carbon::parse($startDate)->startOfQuarter();
            $endPeriod = Carbon::parse($endDate)->endOfQuarter();
        }

        while ($startPeriod->lte($endPeriod)) {
            $periods[] = $startPeriod->format("Y[Q]Q");
            $startPeriod->addQuarter();
        }

        return $periods;
    }

    public static function getNDWDates($startDate, $endDate)
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

    public static function getEIDPeriods($startDate, $endDate)
    {
        $periods = [];
        $startPeriod = Carbon::parse($startDate)->startOfMonth();
        $endPeriod = Carbon::parse($endDate)->endOfMonth();

        $periods[] = $startPeriod->format("Y-m-d");
        $periods[] = $endPeriod->format("Y-m-d");

        return $periods;
    }

    public static function getDATIMPeriods($startDate, $endDate)
    {
        $periods = [];
        $startPeriod = Carbon::parse($startDate);
        $endPeriod = Carbon::parse($endDate);

        if ($startPeriod->gt($endPeriod)) {
            $startPeriod = Carbon::parse($endDate)->startOfQuarter();
            $endPeriod = Carbon::parse($startDate)->endOfQuarter();
        } else {
            $startPeriod = Carbon::parse($startDate)->startOfQuarter();
            $endPeriod = Carbon::parse($endDate)->endOfQuarter();
        }

        while ($startPeriod->lte($endPeriod)) {
            $periods[] = $startPeriod->format("Y[Q]Q");
            $startPeriod->addQuarter();
        }

        return $periods;
    }

    public static function getNDWPeriods($startDate, $endDate)
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
