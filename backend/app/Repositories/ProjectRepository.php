<?php

namespace App\Repositories;

use App\Enums\ProjectStatus;
use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProjectRepository implements ProjectRepositoryInterface
{
    /**
     * Return all published projects, newest first.
     */
    public function getPublished(): Collection
    {
        return Project::query()
            ->published()
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Return all published projects marked as featured.
     */
    public function getFeatured(): Collection
    {
        return Project::query()
            ->published()
            ->where('featured', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Find a single published project by slug.
     */
    public function findPublishedBySlug(string $slug): ?Project
    {
        return Project::query()
            ->where('slug', $slug)
            ->where('status', ProjectStatus::Published)
            ->whereNotNull('published_at')
            ->first();
    }
}
