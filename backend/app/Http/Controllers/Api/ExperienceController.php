<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        $experiences = Experience::orderBy('sort_order')
            ->orderByDesc('is_current')
            ->get();

        return $this->success(ExperienceResource::collection($experiences));
    }
}
