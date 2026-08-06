<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'thumbnail_url',
        'github_url',
        'live_url',
        'featured',
        'status',
        'sort_order',
        'published_at',
        'technologies',
        'gallery',
        'challenges',
        'features',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'sort_order' => 'integer',
        'published_at' => 'datetime',
        'status' => ProjectStatus::class,
        'technologies' => 'array',
        'gallery' => 'array',
        'challenges' => 'array',
        'features' => 'array',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Scope a query to only include published projects.
     *
     * @param  Builder<Project>  $query
     * @return Builder<Project>
     */
    public function scopePublished($query)
    {
        return $query
            ->whereIn('status', ProjectStatus::publicValues())
            ->whereNotNull('published_at');
    }
}
