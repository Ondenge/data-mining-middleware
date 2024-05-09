<?php

namespace App\Http\Controllers;

use App\Models\CtKhis;
use App\Services\CtKhisService;
use Illuminate\Http\Request;

class CtKhisController extends Controller
{
    protected $ct_khis_service;

    public function __construct(CtKhisService $ct_khis_service)
    {
        $this->ct_khis_service = $ct_khis_service;
    }

    public function index()
    {
        $data = CtKhis::paginate();

        return response()->json([
            'status' => 'success',
            'meta' => [
                'total' => $data->total(),
            ],
            'data' => $data->items(),
        ], 200);
    }

    public function reprocess(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if ($startDate && $endDate) {
            $this->ct_khis_service->fetchCTKHISData($startDate, $endDate);

            return response()->json([
                'status' => 'success',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Missing start_date or end_date',
        ], 500);
    }
}
