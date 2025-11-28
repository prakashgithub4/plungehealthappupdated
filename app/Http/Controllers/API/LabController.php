<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lab;
use App\Models\Test;
use App\Http\Resources\Lab\LabResource;
use App\Http\Requests\Lab\CustomerLabTest;
use App\Models\LabTestUser;
use App\Traits\ApiResponseTrait;
use App\Http\Resources\Lab\CustomerTestHistoryResource;

class LabController extends Controller
{
    use ApiResponseTrait;
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $labs = Lab::paginate($perPage);
        return $this->successResponse(LabResource::collection($labs)->response()->getData(true), 'Labs fetched successfully.');
    }
    public function getTest(Request $request)
    {
        $test = Test::where('lab_id', $request->lab_id)->get();
        return $this->successResponse($test, 'Tests fetched successfully.');
    }
    public function submitTest(CustomerLabTest $request)
    {
        LabTestUser::create([
            'lab_id' => $request->laboratory,
            'lab_test_id' => $request->test_id,
            'patient_id' => $request->patientId,
            'test_date' => $request->testDate,
            'customer_id' => auth()->id(),
        ]);
        return $this->successResponse([], 'Lab test submitted successfully.');
    }
    public function getLabTestHistory(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $labTests = LabTestUser::with(['lab', 'test'])
            ->where('customer_id', auth()->id())
            ->paginate($perPage);

        // Format using Resource
        $resourceData = CustomerTestHistoryResource::collection($labTests->items());

        // Build Custom Pagination Response
        $result = [
            'items' => $resourceData,
            'pagination' => [
                'current_page' => $labTests->currentPage(),
                'per_page'     => $labTests->perPage(),
                'total'        => $labTests->total(),
                'last_page'    => $labTests->lastPage(),
                'next_page_url' => $labTests->nextPageUrl(),
                'prev_page_url' => $labTests->previousPageUrl(),
            ]
        ];

        return $this->successResponse($result, 'Lab test history fetched successfully.');
    }
}
