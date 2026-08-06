<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Services\SkillService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SkillController extends Controller
{
    public function __construct(
        private readonly SkillService $skills,
    ) {}

    /**
     * GET /skills
     */
    public function index(): AnonymousResourceCollection
    {
        return CategoryResource::collection($this->skills->listGroupedByCategory());
    }
}
