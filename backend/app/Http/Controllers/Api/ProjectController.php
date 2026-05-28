<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ApiResponse;

    public function index(Request $request): JsonResponse
    {
        $query = Project::with(['category', 'images'])
            ->published()
            ->orderBy('sort_order')
            ->orderByDesc('created_at');

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->boolean('featured')) {
            $query->featured();
        }

        $projects = $query->get();

        return $this->success(ProjectResource::collection($projects));
    }

    public function show(string $slug): JsonResponse
    {
        $project = Project::with(['category', 'images'])
            ->published()
            ->where('slug', $slug)
            ->first();

        if (! $project) {
            return $this->error('Project not found.', 404);
        }

        return $this->success(new ProjectResource($project));
    }
}
