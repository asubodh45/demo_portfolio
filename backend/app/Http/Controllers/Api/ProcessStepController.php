<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProcessStepResource;
use App\Models\ProcessStep;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ProcessStepController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        $steps = ProcessStep::orderBy('step_number')->get();

        return $this->success(ProcessStepResource::collection($steps));
    }
}
