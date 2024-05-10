<?php

namespace App\Http\Controllers;

use App\Models\Fy23Datim;
use App\Services\Fy23DatimService;
use Illuminate\Http\Request;

class Fy23DatimController extends Controller
{
    protected $fy23_datim_service;

    public function __construct(Fy23DatimService $fy23_datim_service)
    {
        $this->fy23_datim_service = $fy23_datim_service;
    }

    public function index()
    {
        $data = Fy23Datim::paginate();

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
            $this->fy23_datim_service->fetchFY23DATIMData($startDate, $endDate);

            return response()->json([
                'status' => 'success',
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Missing Start Date or End Date',
        ], 500);
    }
}
