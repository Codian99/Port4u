<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface SkillRepositoryInterface
{
    /**
     * Return all skills grouped by their category.
     *
     * @return Collection<int, Category>
     */
    public function getGroupedByCategory(): Collection;
}
