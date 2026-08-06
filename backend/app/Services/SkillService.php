<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\Contracts\SkillRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SkillService
{
    public function __construct(
        private readonly SkillRepositoryInterface $skills,
    ) {}

    /**
     * Return all skills grouped by category.
     *
     * @return Collection<int, Category>
     */
    public function listGroupedByCategory(): Collection
    {
        return $this->skills->getGroupedByCategory();
    }
}
