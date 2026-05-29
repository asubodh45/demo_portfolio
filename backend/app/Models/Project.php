<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'tagline', 'description',
        'overview', 'problem', 'approach', 'solution', 'outcome',
        'category_id', 'cover_image', 'year', 'client',
        'tags', 'featured', 'published', 'sort_order',
    ];

    protected $casts = [
        'tags' => 'array',
        'featured' => 'boolean',
        'published' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }
}
