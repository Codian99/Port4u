<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function __construct(
        private readonly ProjectService $projects,
    ) {}

    /**
     * GET /projects
     */
    public function index(): AnonymousResourceCollection
    {
        return ProjectResource::collection($this->projects->listPublished());
    }

    /**
     * GET /projects/featured
     */
    public function featured(): AnonymousResourceCollection
    {
        return ProjectResource::collection($this->projects->listFeatured());
    }

    /**
     * GET /projects/{slug}
     */
    public function show(string $slug): JsonResponse|ProjectResource
    {
        $project = $this->projects->showBySlug($slug);

        if (! $project) {
            return response()->json([
                'message' => 'Project not found.',
            ], 404);
        }

        return new ProjectResource($project);
    }
}
