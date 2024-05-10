<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fy23Datim extends Model
{
    use HasFactory;

    protected $fillable = [
        'DATIMOrgId',
        'siteCode',
        'facilityName',
        'countyName',
        'subCountyName',
        'wardName',
        'ReportQuarter',
        'quarter',
        'year',
        'fy23_hts_tst_total_numerator',
        'fy23_hts_tst_pos',
        'fy23_hts_self_total_numerator',
        'fy23_pmtct_stat_d',
        'fy23_pmtct_stat_pos_knownatentry',
        'fy23_pmtct_stat_numerator',
        'fy23_pmtct_stat_pos',
        'fy23_pmtct_stat_pos_newlyidentified',
        'fy23_pmtct_stat_neg_newlyidentified',
        'fy23_pmtct_art_total_numerator',
        'fy23_pmtct_eid_less_than_2_months',
        'fy23_pmtct_eid_2_to_12_months',
        'fy23_pmtct_fo_died_without_status_known',
        'fy23_pmtct_fo_hiv_final_status_unknown',
        'fy23_pmtct_fo_hiv_infected',
        'fy23_pmtct_fo_hiv_uninfected',
        'fy23_pmtct_fo_total_numerator',
        'fy23_prep_new_total_numerator',
        'fy23_cxca_scrn_total_numerator',
        'fy23_cxca_tx_total_numerator',
        'fy23_vmmc_circ_total_numerator',
        'fy23_tx_new_total_numerator',
        'fy23_tx_curr_total_numerator',
        'fy23_tx_tb_total_numerator',
        'fy23_tb_prev_total_numerator',
        'fy23_tb_art_total_numerator',
        'fy23_kp_tx_curr',
    ];

    public $incrementing = false;
}
