<?php

namespace App\Services;

use App\Models\Experience;
use App\Repositories\Contracts\ExperienceRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ExperienceService
{
    public function __construct(
        private readonly ExperienceRepositoryInterface $experiences,
    ) {}

    /**
     * Return all experiences.
     *
     * @return Collection<int, Experience>
     */
    public function listAll(): Collection
    {
        return $this->experiences->getAll();
    }
}
