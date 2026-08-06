<?php

namespace App\Repositories\Contracts;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;

interface ProjectRepositoryInterface
{
    /**
     * Return all published projects, newest first.
     *
     * @return Collection<int, Project>
     */
    public function getPublished(): Collection;

    /**
     * Return all published projects marked as featured.
     *
     * @return Collection<int, Project>
     */
    public function getFeatured(): Collection;

    /**
     * Find a single published project by slug.
     */
    public function findPublishedBySlug(string $slug): ?Project;
}
