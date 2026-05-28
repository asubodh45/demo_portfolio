<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'tagline' => $this->tagline,
            'description' => $this->description,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'cover_image' => $this->cover_image,
            'year' => $this->year,
            'client' => $this->client,
            'tags' => $this->tags ?? [],
            'featured' => $this->featured,
            'published' => $this->published,
            'sort_order' => $this->sort_order,
            'images' => ProjectImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
