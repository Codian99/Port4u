<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExperienceResource;
use App\Services\ExperienceService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExperienceController extends Controller
{
    public function __construct(
        private readonly ExperienceService $experiences,
    ) {}

    /**
     * GET /experience
     */
    public function index(): AnonymousResourceCollection
    {
        return ExperienceResource::collection($this->experiences->listAll());
    }
}
