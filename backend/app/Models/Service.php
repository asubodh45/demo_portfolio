<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'deliverables', 'icon', 'published', 'sort_order'];

    protected $casts = [
        'deliverables' => 'array',
        'published' => 'boolean',
    ];
}
