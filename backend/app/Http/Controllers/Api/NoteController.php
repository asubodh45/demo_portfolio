<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;

class NoteController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        $notes = Note::published()
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->get(['id', 'title', 'slug', 'excerpt', 'cover_image', 'published_at']);

        return $this->success(NoteResource::collection($notes));
    }

    public function show(string $slug): JsonResponse
    {
        $note = Note::published()->where('slug', $slug)->first();

        if (! $note) {
            return $this->error('Note not found.', 404);
        }

        return $this->success(new NoteResource($note));
    }
}
