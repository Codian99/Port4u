<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\SkillRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class SkillRepository implements SkillRepositoryInterface
{
    /**
     * Return all categories eager-loaded with their skills.
     */
    public function getGroupedByCategory(): Collection
    {
        return Category::query()
            ->with('skills')
            ->orderBy('sort_order')
            ->get();
    }
}
