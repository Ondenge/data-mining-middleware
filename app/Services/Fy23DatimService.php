<?php

namespace App\Services;

use App\Models\Fy23Datim;
use Illuminate\Support\Facades\Http;
use App\Helpers\Utils;
use Illuminate\Support\Facades\Log;

class Fy23DatimService
{
    public function fetchFY23DATIMData($startDate, $endDate)
    {
        $start = date("Y-m-d", strtotime($startDate));
        $end = date("Y-m-d", strtotime($endDate));
        $periods = Utils::getDATIMDates($start, $end);

        foreach ($periods as $period) {
            $this->fetchFY23DATIMDataForDates($period);
        }
    }

    public function fetchFY23DATIMDataForDates($period)
    {
        $ou = "dimension=ou:HfVjCurKxh2;LEVEL-rUte6ZcDXew;";
        $de = "dimension=dx:YxLqDH890Zz;TNP4PyEAEeo;BjXdW2DrgVv;s8yV6ilwJW3;BopwUHaWoak;On0P2lvIjOw;q9BtI3V6Srr;cu01rcSmc7R;gjuP6rsCr7W;d4L0MnM0IHA;cYAv75XmIy7;lL76aw6PHN3;V3j9i61PAl4;XOFMZLwOMAW;wvxIVL6yDOm;DqKXExwThoz;r2rn6kiHzWh;XizF21cVBRK;bnVFXzOUMuU;ubwb9xlwDCX;ldLWHwLqS27;kf5I5HO0WS6;Av10gCzYytj;jCqb7uwsiQj;YxakI4GwXpD;SCtGdBchqvO;SICiUxkhBgh;";
        $pe = "dimension=pe:" . $period . ";";
        $query = "/analytics?" . $ou . "&" . $de . "&" . $pe . "&showHierarchy=true&hierarchyMeta=false&includeMetadataDetails=false&includeNumDen=false&tableLayout=true&columns=dx;pe&rows=ou&skipRounding=false&completedOnly=false&outputIdScheme=NAME";

        $config = [
            'url' => $query,
            'timeout' => 30 * 60 * 2000, // 30 min
            'base_uri' => env('DATIM_API_BASE_URL'),
            'headers' => ['Content-Type' => 'application/json'],
            'auth' => [env('DATIM_USERNAME'), env('DATIM_PASSWORD')],
        ];

        try {
            $response = Http::withOptions($config)->get(env('DATIM_API_BASE_URL') . $query);
            $data = $response->json();

            if (isset($data['rows'])) {
                foreach ($data['rows'] as $row) {
                    $rowData = [
                        'DATIMOrgId' => isset($row[5]) && trim($row[5]) !== "" ? $row[5] : null,
                        'siteCode' => isset($row[7]) && trim($row[7]) !== "" ? $row[7] : null,
                        'facilityName' => isset($row[6]) && trim($row[6]) !== "" ? $row[6] : null,
                        'countyName' => isset($row[1]) && trim($row[1]) !== "" ? str_replace(" County", "", $row[1]) : null,
                        'subCountyName' => isset($row[2]) && trim($row[2]) !== "" ? str_replace(" Sub County", "", $row[2]) : null,
                        'wardName' => isset($row[3]) && trim($row[3]) !== "" ? str_replace(" Ward", "", $row[3]) : null,
                        'ReportQuarter' => $period,
                        'quarter' => substr($period, 4, 6),
                        'year' => substr($period, 0, 4),
                        'fy23_hts_tst_total_numerator' => isset($row[9]) && trim($row[9]) !== "" ? (int) $row[9] : null,
                        'fy23_hts_tst_pos' => isset($row[10]) && trim($row[10]) !== "" ? (int) $row[10] : null,
                        'fy23_hts_self_total_numerator' => isset($row[11]) && trim($row[11]) !== "" ? (int) $row[11] : null,
                        'fy23_pmtct_stat_d' => isset($row[12]) && trim($row[12]) !== "" ? (int) $row[12] : null,
                        'fy23_pmtct_stat_pos_knownatentry' => isset($row[13]) && trim($row[13]) !== "" ? (int) $row[13] : null,
                        'fy23_pmtct_stat_numerator' => isset($row[14]) && trim($row[14]) !== "" ? (int) $row[14] : null,
                        'fy23_pmtct_stat_pos' => isset($row[15]) && trim($row[15]) !== "" ? (int) $row[15] : null,
                        'fy23_pmtct_stat_pos_newlyidentified' => isset($row[16]) && trim($row[16]) !== "" ? (int) $row[16] : null,
                        'fy23_pmtct_stat_neg_newlyidentified' => isset($row[17]) && trim($row[17]) !== "" ? (int) $row[17] : null,
                        'fy23_pmtct_art_total_numerator' => isset($row[18]) && trim($row[18]) !== "" ? (int) $row[18] : null,
                        'fy23_pmtct_eid_less_than_2_months' => isset($row[19]) && trim($row[19]) !== "" ? (int) $row[19] : null,
                        'fy23_pmtct_eid_2_to_12_months' => isset($row[20]) && trim($row[20]) !== "" ? (int) $row[20] : null,
                        'fy23_pmtct_fo_died_without_status_known' => isset($row[21]) && trim($row[21]) !== "" ? (int) $row[21] : null,
                        'fy23_pmtct_fo_hiv_final_status_unknown' => isset($row[22]) && trim($row[22]) !== "" ? (int) $row[22] : null,
                        'fy23_pmtct_fo_hiv_infected' => isset($row[23]) && trim($row[23]) !== "" ? (int) $row[23] : null,
                        'fy23_pmtct_fo_hiv_uninfected' => isset($row[24]) && trim($row[24]) !== "" ? (int) $row[24] : null,
                        'fy23_pmtct_fo_total_numerator' => isset($row[25]) && trim($row[25]) !== "" ? (int) $row[25] : null,
                        'fy23_prep_new_total_numerator' => isset($row[26]) && trim($row[26]) !== "" ? (int) $row[26] : null,
                        'fy23_cxca_scrn_total_numerator' => isset($row[27]) && trim($row[27]) !== "" ? (int) $row[27] : null,
                        'fy23_cxca_tx_total_numerator' => isset($row[28]) && trim($row[28]) !== "" ? (int) $row[28] : null,
                        'fy23_vmmc_circ_total_numerator' => isset($row[29]) && trim($row[29]) !== "" ? (int) $row[29] : null,
                        'fy23_tx_new_total_numerator' => isset($row[30]) && trim($row[30]) !== "" ? (int) $row[30] : null,
                        'fy23_tx_curr_total_numerator' => isset($row[31]) && trim($row[31]) !== "" ? (int) $row[31] : null,
                        'fy23_tx_tb_total_numerator' => isset($row[32]) && trim($row[32]) !== "" ? (int) $row[32] : null,
                        'fy23_tb_prev_total_numerator' => isset($row[33]) && trim($row[33]) !== "" ? (int) $row[33] : null,
                        'fy23_tb_art_total_numerator' => isset($row[34]) && trim($row[34]) !== "" ? (int) $row[34] : null,
                        'fy23_kp_tx_curr' => isset($row[35]) && trim($row[35]) !== "" ? (int) $row[35] : null,
                    ];

                    Fy23Datim::updateOrCreate(
                        ['DATIMOrgId' => $rowData['DATIMOrgId'], 'ReportQuarter' => $rowData['ReportQuarter']],
                        $rowData
                    );
                }
            }
        } catch (\Exception $e) {
            Log::error("fetchFY23DATIMData for " . $period . " failed at " . now() . " Reason: " . $e->getMessage());
        }
    }
}
