<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail_url,
            'github_url' => $this->github_url,
            'live_url' => $this->live_url,
            'featured' => $this->featured,
            'technologies' => $this->technologies,
            'gallery' => $this->gallery,
            'challenges' => $this->challenges,
            'features' => $this->features,
            'published_at' => $this->published_at?->toIso8601String(),
        ];
    }
}
