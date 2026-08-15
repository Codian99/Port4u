<?php

namespace Tests\Feature\Api;

use App\Enums\ContactStatus;
use App\Models\Contact;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_endpoint_returns_profile_data(): void
    {
        $response = $this->getJson('/api/v1/about');

        $response->assertOk()
            ->assertJsonStructure(['name', 'title', 'summary', 'email', 'social']);
    }

    public function test_projects_endpoint_returns_only_published_projects(): void
    {
        $this->seed();

        $response = $this->getJson('/api/v1/projects');

        $response->assertOk()
            ->assertJsonCount(Project::published()->count(), 'data')
            ->assertJsonStructure(['data' => [['title', 'slug', 'summary', 'thumbnail', 'technologies']]]);
    }

    public function test_featured_projects_endpoint_returns_only_featured(): void
    {
        $this->seed();

        $response = $this->getJson('/api/v1/projects/featured');

        $response->assertOk();
        collect($response->json('data'))->each(
            fn (array $project) => $this->assertTrue($project['featured']),
        );
    }

    public function test_skills_endpoint_returns_categories_with_nested_skills(): void
    {
        $this->seed();

        $response = $this->getJson('/api/v1/skills');

        $response->assertOk()
            ->assertJsonCount(5, 'data')
            ->assertJsonStructure(['data' => [['name', 'slug', 'icon', 'skills']]]);
    }

    public function test_experience_endpoint_returns_ordered_timeline(): void
    {
        $this->seed();

        $response = $this->getJson('/api/v1/experience');

        $response->assertOk()
            ->assertJsonStructure(['data' => [['role', 'company', 'start_date', 'current']]]);
    }

    public function test_contact_endpoint_validates_and_creates_message(): void
    {
        $payload = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'subject' => 'Project inquiry',
            'message' => 'I would like to discuss a new project with you.',
        ];

        $this->postJson('/api/v1/contact', $payload)
            ->assertCreated()
            ->assertJsonPath('data.email', 'jane@example.com');

        $this->assertDatabaseHas('contacts', ['email' => 'jane@example.com']);
        $this->assertSame(ContactStatus::New, Contact::first()->status);
    }

    public function test_contact_endpoint_rejects_invalid_payload(): void
    {
        $this->postJson('/api/v1/contact', [
            'name' => '',
            'email' => 'not-an-email',
            'subject' => '',
            'message' => 'short',
        ])->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'subject', 'message']);
    }
}
