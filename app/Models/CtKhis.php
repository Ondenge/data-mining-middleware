<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtKhis extends Model
{
    use HasFactory;
    protected $fillable = [
        'KHISOrgId',
        'siteCode',
        'facilityName',
        'countyName',
        'subCountyName',
        'wardName',
        'ReportMonth_Year',
        'month',
        'year',
        'Enrolled_Total',
        'StartedART_Total',
        'CurrentOnART_Total',
        'CTX_Total',
        'OnART_12Months',
        'NetCohort_12Months',
        'VLSuppression_12Months',
        'VLResultAvail_12Months',
    ];

    public $incrementing = false;
}
