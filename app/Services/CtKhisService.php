<?php

namespace App\Services;

use App\Models\CtKhis;
use Illuminate\Support\Facades\Http;
use App\Helpers\Utils;
use Illuminate\Support\Facades\Log;

class CtKhisService
{
    public function fetchCTKHISData($startDate, $endDate)
    {
        $start = date("Y-m-d", strtotime($startDate));
        $end = date("Y-m-d", strtotime($endDate));
        $periods = Utils::getKHISDates($start, $end);

        foreach ($periods as $period) {
            $this->fetchCTKHISDataForDates($period);
        }
    }

    public function fetchCTKHISDataForDates($period)
    {
        $ou = "dimension=ou:LEVEL-5;";
        $de = "dimension=dx:JljuWsCDpma;sEtNuNusKTT;PUrg2dmCjGI;QrHtUO7UsaM;S1z1doLHQg1;cbrwRebovN1;RNfqUayuZP2;MR5lxj7v7Lt;";
        $pe = "dimension=pe:" . $period . ";";
        $query = "/analytics?" . $ou . "&" . $de . "&" . $pe . "&displayProperty=NAME&showHierarchy=true&tableLayout=true&columns=dx;pe&rows=ou&hideEmptyRows=true&paging=false";

        $config = [
            'url' => $query,
            'timeout' => 30 * 60 * 2000, // 30 min
            'base_uri' => env('KHIS_API_BASE_URL'),
            'headers' => ['Content-Type' => 'application/json'],
            'auth' => [env('KHIS_USERNAME'), env('KHIS_PASSWORD')],
        ];

        try {
            $response = Http::withOptions($config)->get(env('KHIS_API_BASE_URL') . $query);
            $data = $response->json();

            if (isset($data['rows'])) {
                foreach ($data['rows'] as $row) {
                    $rowData = [
                        'KHISOrgId' => isset($row[5]) && trim($row[5]) !== "" ? $row[5] : null,
                        'siteCode' => isset($row[7]) && trim($row[7]) !== "" ? $row[7] : null,
                        'facilityName' => isset($row[6]) && trim($row[6]) !== "" ? $row[6] : null,
                        'countyName' => isset($row[1]) && trim($row[1]) !== "" ? str_replace(" County", "", $row[1]) : null,
                        'subCountyName' => isset($row[2]) && trim($row[2]) !== "" ? str_replace(" Sub County", "", $row[2]) : null,
                        'wardName' => isset($row[3]) && trim($row[3]) !== "" ? str_replace(" Ward", "", $row[3]) : null,
                        'ReportMonth_Year' => $period,
                        'month' => substr($period, 4, 2),
                        'year' => substr($period, 0, 4),
                        'Enrolled_Total' => isset($row[9]) && trim($row[9]) !== "" ? (int)$row[9] : null,
                        'StartedART_Total' => isset($row[10]) && trim($row[10]) !== "" ? (int)$row[10] : null,
                        'CurrentOnART_Total' => isset($row[11]) && trim($row[11]) !== "" ? (int)$row[11] : null,
                        'CTX_Total' => isset($row[12]) && trim($row[12]) !== "" ? (int)$row[12] : null,
                        'OnART_12Months' => isset($row[13]) && trim($row[13]) !== "" ? (int)$row[13] : null,
                        'NetCohort_12Months' => isset($row[14]) && trim($row[14]) !== "" ? (int)$row[14] : null,
                        'VLSuppression_12Months' => isset($row[15]) && trim($row[15]) !== "" ? (int)$row[15] : null,
                        'VLResultAvail_12Months' => isset($row[16]) && trim($row[16]) !== "" ? (int)$row[16] : null,
                    ];

                    CtKhis::updateOrCreate(
                        ['KHISOrgId' => $rowData['KHISOrgId'], 'ReportMonth_Year' => $rowData['ReportMonth_Year']],
                        $rowData
                    );
                }
            }
        } catch (\Exception $e) {
            Log::error("ProcessCTKHISDash for " . $period . " failed at " . now() . " Reason: " . $e->getMessage());
        }
    }
}
