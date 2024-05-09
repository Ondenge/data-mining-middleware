<?php

use App\Services\CtKhisService;
use Carbon\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('DAILY#CT_KHIS', function () {
    $ct_khis_service = app(CtKhisService::class);
    $period = Carbon::now()->subMonth()->format('Ym');
    $ct_khis_service->fetchCTKHISDataForDates($period);
})->dailyAt('23:35');

Artisan::command('MONTHLY#CT_KHIS', function () {
    $ct_khis_service = app(CtKhisService::class);
    $startDate = '2020-01-01';
    $endDate = Carbon::now()->subMonths(2)->endOfMonth()->format('Y-m-d');
    $ct_khis_service->fetchCTKHISData($startDate, $endDate);
})->monthlyOn(9, '23:27');
