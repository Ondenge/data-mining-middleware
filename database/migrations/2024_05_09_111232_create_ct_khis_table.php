<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ct_khis', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(\Illuminate\Support\Facades\DB::raw('(UUID())'));
            $table->string('KHISOrgId')->index();
            $table->string('siteCode')->index()->nullable();
            $table->string('facilityName')->index();
            $table->string('countyName')->index();
            $table->string('subCountyName')->index();
            $table->string('wardName')->index();
            $table->string('ReportMonth_Year');
            $table->string('month');
            $table->string('year');
            $table->integer('Enrolled_Total')->nullable();
            $table->integer('StartedART_Total')->nullable();
            $table->integer('CurrentOnART_Total')->nullable();
            $table->integer('CTX_Total')->nullable();
            $table->integer('OnART_12Months')->nullable();
            $table->integer('NetCohort_12Months')->nullable();
            $table->integer('VLSuppression_12Months')->nullable();
            $table->integer('VLResultAvail_12Months')->nullable();
            $table->timestamps();
        });

        Schema::table('ct_khis', function (Blueprint $table) {
            $table->index(['KHISOrgId', 'siteCode', 'ReportMonth_Year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ct_khis');
    }
};
