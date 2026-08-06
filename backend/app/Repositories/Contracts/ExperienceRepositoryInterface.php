<?php

namespace App\Repositories\Contracts;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Collection;

interface ExperienceRepositoryInterface
{
    /**
     * Return all experiences ordered newest-first.
     *
     * @return Collection<int, Experience>
     */
    public function getAll(): Collection;
}
