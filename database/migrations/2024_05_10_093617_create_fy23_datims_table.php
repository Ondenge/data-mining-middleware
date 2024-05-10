<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fy23_datims', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(\Illuminate\Support\Facades\DB::raw('(UUID())'));
            $table->string('DATIMOrgId')->index();
            $table->string('siteCode')->index()->nullable();
            $table->string('facilityName')->index();
            $table->string('countyName')->index();
            $table->string('subCountyName')->index();
            $table->string('wardName')->index();
            $table->string('ReportQuarter');
            $table->string('quarter');
            $table->string('year');
            $table->integer('fy23_hts_tst_total_numerator')->nullable();
            $table->integer('fy23_hts_tst_pos')->nullable();
            $table->integer('fy23_hts_self_total_numerator')->nullable();
            $table->integer('fy23_pmtct_stat_d')->nullable();
            $table->integer('fy23_pmtct_stat_pos_knownatentry')->nullable();
            $table->integer('fy23_pmtct_stat_numerator')->nullable();
            $table->integer('fy23_pmtct_stat_pos')->nullable();
            $table->integer('fy23_pmtct_stat_pos_newlyidentified')->nullable();
            $table->integer('fy23_pmtct_stat_neg_newlyidentified')->nullable();
            $table->integer('fy23_pmtct_art_total_numerator')->nullable();
            $table->integer('fy23_pmtct_eid_less_than_2_months')->nullable();
            $table->integer('fy23_pmtct_eid_2_to_12_months')->nullable();
            $table->integer('fy23_pmtct_fo_died_without_status_known')->nullable();
            $table->integer('fy23_pmtct_fo_hiv_final_status_unknown')->nullable();
            $table->integer('fy23_pmtct_fo_hiv_infected')->nullable();
            $table->integer('fy23_pmtct_fo_hiv_uninfected')->nullable();
            $table->integer('fy23_pmtct_fo_total_numerator')->nullable();
            $table->integer('fy23_prep_new_total_numerator')->nullable();
            $table->integer('fy23_cxca_scrn_total_numerator')->nullable();
            $table->integer('fy23_cxca_tx_total_numerator')->nullable();
            $table->integer('fy23_vmmc_circ_total_numerator')->nullable();
            $table->integer('fy23_tx_new_total_numerator')->nullable();
            $table->integer('fy23_tx_curr_total_numerator')->nullable();
            $table->integer('fy23_tx_tb_total_numerator')->nullable();
            $table->integer('fy23_tb_prev_total_numerator')->nullable();
            $table->integer('fy23_tb_art_total_numerator')->nullable();
            $table->integer('fy23_kp_tx_curr')->nullable();
            $table->timestamps();
        });

        Schema::table('fy23_datims', function (Blueprint $table) {
            $table->index(['DATIMOrgId', 'siteCode', 'ReportQuarter']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fy23_datims');
    }
};
