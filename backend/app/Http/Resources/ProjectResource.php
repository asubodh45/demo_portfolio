<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'slug'       => $this->slug,
            'tagline'    => $this->tagline,
            'category'   => $this->whenLoaded('category', fn () => $this->category?->name),
            'thumbnail'  => $this->cover_image ? Storage::disk('public')->url($this->cover_image) : null,
            'year'       => $this->year,
            'client'     => $this->client,
            'tags'       => $this->tags ?? [],
            'featured'   => $this->featured,
            'overview'   => $this->overview,
            'problem'    => $this->problem,
            'approach'   => $this->approach,
            'solution'   => $this->solution,
            'outcome'    => $this->outcome,
            'images'     => $this->whenLoaded('images', fn () => $this->images->map(fn ($img) => Storage::disk('public')->url($img->url))),
        ];
    }
}
