<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        $skills = Skill::orderBy('sort_order')->orderBy('name')->get();

        return $this->success(SkillResource::collection($skills));
    }
}
