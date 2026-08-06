<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\Contracts\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    public function __construct(
        private readonly ProjectRepositoryInterface $projects,
    ) {}

    /**
     * Return all published projects.
     *
     * @return Collection<int, Project>
     */
    public function listPublished(): Collection
    {
        return $this->projects->getPublished();
    }

    /**
     * Return featured projects.
     *
     * @return Collection<int, Project>
     */
    public function listFeatured(): Collection
    {
        return $this->projects->getFeatured();
    }

    /**
     * Find a single published project by slug.
     */
    public function showBySlug(string $slug): ?Project
    {
        return $this->projects->findPublishedBySlug($slug);
    }
}
