<?php

namespace App\Repositories;

use App\Models\Experience;
use App\Repositories\Contracts\ExperienceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ExperienceRepository implements ExperienceRepositoryInterface
{
    /**
     * Return all experiences ordered newest-first.
     */
    public function getAll(): Collection
    {
        return Experience::query()
            ->newestFirst()
            ->get();
    }
}
