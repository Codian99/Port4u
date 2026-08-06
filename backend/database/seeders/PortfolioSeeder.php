<?php

namespace Database\Seeders;

use App\Enums\ContactStatus;
use App\Enums\ProjectStatus;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Seed the portfolio demo data.
     */
    public function run(): void
    {
        $this->seedCategoriesAndSkills();
        $this->seedProjects();
        $this->seedExperience();
        $this->seedContacts();
    }

    /**
     * Seed skill categories and their skills.
     */
    private function seedCategoriesAndSkills(): void
    {
        $categories = [
            'frontend' => [
                'name' => 'Frontend',
                'icon' => 'lucide:monitor',
                'skills' => [
                    ['name' => 'Nuxt 4', 'level' => 92, 'icon' => 'lucide:atom'],
                    ['name' => 'Vue 3', 'level' => 95, 'icon' => 'lucide:atom'],
                    ['name' => 'Tailwind CSS', 'level' => 90, 'icon' => 'lucide:palette'],
                    ['name' => 'JavaScript', 'level' => 94, 'icon' => 'lucide:code-2'],
                    ['name' => 'TypeScript', 'level' => 85, 'icon' => 'lucide:file-type'],
                ],
            ],
            'backend' => [
                'name' => 'Backend',
                'icon' => 'lucide:server',
                'skills' => [
                    ['name' => 'Laravel', 'level' => 92, 'icon' => 'lucide:box'],
                    ['name' => 'PHP', 'level' => 93, 'icon' => 'lucide:braces'],
                    ['name' => 'REST API', 'level' => 90, 'icon' => 'lucide:network'],
                ],
            ],
            'database' => [
                'name' => 'Database',
                'icon' => 'lucide:database',
                'skills' => [
                    ['name' => 'MySQL', 'level' => 88, 'icon' => 'lucide:database'],
                    ['name' => 'Redis', 'level' => 75, 'icon' => 'lucide:zap'],
                ],
            ],
            'devops' => [
                'name' => 'DevOps',
                'icon' => 'lucide:container',
                'skills' => [
                    ['name' => 'Docker', 'level' => 85, 'icon' => 'lucide:container'],
                    ['name' => 'Linux', 'level' => 80, 'icon' => 'lucide:terminal'],
                    ['name' => 'Nginx', 'level' => 82, 'icon' => 'lucide:settings'],
                    ['name' => 'cPanel', 'level' => 88, 'icon' => 'lucide:layers'],
                ],
            ],
            'cms' => [
                'name' => 'CMS',
                'icon' => 'lucide:file-text',
                'skills' => [
                    ['name' => 'WordPress', 'level' => 95, 'icon' => 'lucide:globe'],
                    ['name' => 'Elementor', 'level' => 90, 'icon' => 'lucide:layout'],
                    ['name' => 'WPBakery', 'level' => 85, 'icon' => 'lucide:layout-template'],
                    ['name' => 'WooCommerce', 'level' => 88, 'icon' => 'lucide:shopping-cart'],
                    ['name' => 'Custom Plugins', 'level' => 90, 'icon' => 'lucide:puzzle'],
                    ['name' => 'Custom Themes', 'level' => 88, 'icon' => 'lucide:paintbrush'],
                ],
            ],
            'tools' => [
                'name' => 'Tools',
                'icon' => 'lucide:wrench',
                'skills' => [
                    ['name' => 'Git', 'level' => 90, 'icon' => 'lucide:git-branch'],
                    ['name' => 'GitHub', 'level' => 92, 'icon' => 'lucide:github'],
                    ['name' => 'Bitbucket', 'level' => 80, 'icon' => 'lucide:git-pull-request'],
                    ['name' => 'Composer', 'level' => 85, 'icon' => 'lucide:package'],
                    ['name' => 'npm', 'level' => 88, 'icon' => 'lucide:box'],
                ],
            ],
        ];

        $sort = 0;
        foreach ($categories as $slug => $data) {
            $category = Category::updateOrCreate(['slug' => $slug], [
                'name' => $data['name'],
                'icon' => $data['icon'],
                'sort_order' => $sort++,
            ]);

            foreach ($data['skills'] as $skillIndex => $skill) {
                Skill::updateOrCreate(
                    ['category_id' => $category->id, 'name' => $skill['name']],
                    ['level' => $skill['level'], 'icon' => $skill['icon'], 'sort_order' => $skillIndex],
                );
            }
        }
    }

    /**
     * Seed the sample projects.
     */
    private function seedProjects(): void
    {
        $projects = [
            [
                'title' => 'WordPress Portfolio Website',
                'slug' => 'wordpress-portfolio-website',
                'summary' => 'A pixel-perfect, SEO-optimised portfolio website built on WordPress with a fully custom theme.',
                'description' => 'A premium portfolio website for a creative professional. Built from scratch as a custom WordPress theme with zero page-builder overhead. Optimised for Core Web Vitals, accessibility and search engines. Includes a custom post-type driven projects section, animation on scroll, and a fully responsive mobile-first layout.',
                'thumbnail' => '/images/projects/wordpress-portfolio-website.svg',
                'github' => 'https://github.com/yourusername/wordpress-portfolio-website',
                'live' => 'https://example.com',
                'featured' => true,
                'technologies' => ['WordPress', 'PHP', 'JavaScript', 'SCSS', 'ACF'],
                'gallery' => ['/images/projects/wordpress-portfolio-website.svg'],
                'challenges' => [
                    'Achieving 95+ PageSpeed scores while keeping heavy visual effects.',
                    'Building a content system editors actually enjoy using.',
                ],
                'features' => [
                    'Custom Gutenberg blocks',
                    'Advanced custom fields for projects',
                    'Lazy-loaded media with responsive sizing',
                ],
            ],
            [
                'title' => 'Custom WooCommerce Plugin',
                'slug' => 'custom-woocommerce-plugin',
                'summary' => 'A feature-rich WooCommerce plugin that adds flexible shipping rules and bulk product tools.',
                'description' => 'A production WooCommerce plugin deployed on dozens of client stores. Adds conditional shipping methods based on cart contents, customer location and user roles. Ships with a settings page, custom database tables, scheduled price updates and full translation support.',
                'thumbnail' => '/images/projects/custom-woocommerce-plugin.svg',
                'github' => 'https://github.com/yourusername/custom-woocommerce-plugin',
                'live' => 'https://example.com',
                'featured' => true,
                'technologies' => ['WordPress', 'WooCommerce', 'PHP', 'MySQL'],
                'gallery' => ['/images/projects/custom-woocommerce-plugin.svg'],
                'challenges' => [
                    'Keeping the plugin backwards compatible across three WooCommerce major versions.',
                    'Optimising scheduled bulk updates to run within memory limits on shared hosting.',
                ],
                'features' => [
                    'Conditional shipping rules engine',
                    'Bulk product editor',
                    'i18n ready with po/mo files',
                ],
            ],
            [
                'title' => 'Laravel REST API',
                'slug' => 'laravel-rest-api',
                'summary' => 'A production-grade REST API with Sanctum auth, repository pattern and versioned endpoints.',
                'description' => 'A fully documented, versioned REST API built with Laravel. Implements token-based authentication with Sanctum, request validation through Form Requests, and a clean repository + service layer architecture. Includes rate limiting, API resources for consistent JSON output, and an OpenAPI spec.',
                'thumbnail' => '/images/projects/laravel-rest-api.svg',
                'github' => 'https://github.com/yourusername/laravel-rest-api',
                'live' => 'https://example.com',
                'featured' => true,
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'Sanctum', 'Redis'],
                'gallery' => ['/images/projects/laravel-rest-api.svg'],
                'challenges' => [
                    'Designing a versioning strategy that avoids breaking existing consumers.',
                    'Shaping consistent error responses across every endpoint.',
                ],
                'features' => [
                    'Versioned /api/v1 namespace',
                    'Sanctum token authentication',
                    'Form Request validation',
                ],
            ],
            [
                'title' => 'Nuxt Dashboard',
                'slug' => 'nuxt-dashboard',
                'summary' => 'A modern admin dashboard with charts, dark mode and role-based views, built in Nuxt 4.',
                'description' => 'A real-time admin dashboard built with Nuxt 4, Pinia and Tailwind CSS. Features interactive charts, user management screens, role-based access, and a polished dark theme. Data is fetched through a typed API layer and cached client-side for a snappy experience.',
                'thumbnail' => '/images/projects/nuxt-dashboard.svg',
                'github' => 'https://github.com/yourusername/nuxt-dashboard',
                'live' => 'https://example.com',
                'featured' => false,
                'technologies' => ['Nuxt 4', 'Vue 3', 'TypeScript', 'Tailwind CSS', 'Pinia'],
                'gallery' => ['/images/projects/nuxt-dashboard.svg'],
                'challenges' => [
                    'Keeping the bundle lean while shipping charts and tables.',
                    'Handling real-time updates without layout thrash.',
                ],
                'features' => [
                    'Dark / light theme',
                    'Interactive analytics charts',
                    'Role-based navigation',
                ],
            ],
            [
                'title' => 'Dockerized Web Application',
                'slug' => 'dockerized-web-application',
                'summary' => 'A full stack application containerised with Docker Compose for a one-command local environment.',
                'description' => 'A complete stack — Nginx, Laravel API, Nuxt frontend, MySQL and Redis — packaged into Docker Compose services. Includes health checks, persistent volumes, a shared network, and production multi-stage builds that shrink images by 60%.',
                'thumbnail' => '/images/projects/dockerized-web-application.svg',
                'github' => 'https://github.com/yourusername/dockerized-web-application',
                'live' => 'https://example.com',
                'featured' => false,
                'technologies' => ['Docker', 'Docker Compose', 'Nginx', 'Laravel', 'Nuxt'],
                'gallery' => ['/images/projects/dockerized-web-application.svg'],
                'challenges' => [
                    'Shrinking production image size without losing build cache benefits.',
                    'Coordinating startup order between the API, database and queue workers.',
                ],
                'features' => [
                    'Multi-stage production builds',
                    'Health-checked services',
                    'Named volumes for persistent data',
                ],
            ],
            [
                'title' => 'WordPress Malware Scanner',
                'slug' => 'wordpress-malware-scanner',
                'summary' => 'A WordPress security plugin that scans core files, themes and plugins for known malware signatures.',
                'description' => 'A security-focused WordPress plugin that fingerprints core files, detects modified hashes and scans for common malware signatures. Provides one-click cleanup reports and scheduled scans via WP-Cron. Built with performance in mind to run on budget shared hosting.',
                'thumbnail' => '/images/projects/wordpress-malware-scanner.svg',
                'github' => 'https://github.com/yourusername/wordpress-malware-scanner',
                'live' => 'https://example.com',
                'featured' => false,
                'technologies' => ['WordPress', 'PHP', 'MySQL'],
                'gallery' => ['/images/projects/wordpress-malware-scanner.svg'],
                'challenges' => [
                    'Scanning thousands of files within PHP memory and time limits.',
                    'Avoiding false positives from legitimately customised themes.',
                ],
                'features' => [
                    'File hash integrity checker',
                    'Signature-based malware detection',
                    'Scheduled background scans',
                ],
            ],
            [
                'title' => 'Booking System',
                'slug' => 'booking-system',
                'summary' => 'An appointment booking system with availability calendars, reminders and payment-ready checkout.',
                'description' => 'A full booking platform handling multiple service providers, working hours and overlapping calendars. Includes a public booking flow with live availability, email reminders, and an admin panel for managing slots. API-first design so it can be embedded anywhere.',
                'thumbnail' => '/images/projects/booking-system.svg',
                'github' => 'https://github.com/yourusername/booking-system',
                'live' => 'https://example.com',
                'featured' => false,
                'technologies' => ['Laravel', 'Vue 3', 'MySQL', 'Redis'],
                'gallery' => ['/images/projects/booking-system.svg'],
                'challenges' => [
                    'Preventing double-bookings under concurrent requests.',
                    'Modelling recurring availability rules cleanly.',
                ],
                'features' => [
                    'Real-time availability calendar',
                    'Automated email reminders',
                    'Multi-provider scheduling',
                ],
            ],
            [
                'title' => 'Sports Management System',
                'slug' => 'sports-management-system',
                'summary' => 'A management platform for teams, fixtures, results and player statistics.',
                'description' => 'A sports league management system with team rosters, fixture generation, live score entry and player statistics. Includes role-based permissions for league admins, club managers and scorers, plus public standings and match pages.',
                'thumbnail' => '/images/projects/sports-management-system.svg',
                'github' => 'https://github.com/yourusername/sports-management-system',
                'live' => 'https://example.com',
                'featured' => false,
                'technologies' => ['Laravel', 'Vue 3', 'MySQL'],
                'gallery' => ['/images/projects/sports-management-system.svg'],
                'challenges' => [
                    'Designing a flexible fixture-generation algorithm.',
                    'Aggregating statistics across seasons without slow queries.',
                ],
                'features' => [
                    'Fixture and result management',
                    'Player statistics dashboard',
                    'Role-based access control',
                ],
            ],
        ];

        foreach ($projects as $index => $project) {
            Project::updateOrCreate(['slug' => $project['slug']], [
                'title' => $project['title'],
                'summary' => $project['summary'],
                'description' => $project['description'],
                'thumbnail_url' => $project['thumbnail'],
                'github_url' => $project['github'],
                'live_url' => $project['live'],
                'featured' => $project['featured'],
                'status' => ProjectStatus::Published,
                'sort_order' => $index,
                'technologies' => $project['technologies'],
                'gallery' => $project['gallery'],
                'challenges' => $project['challenges'],
                'features' => $project['features'],
                'published_at' => now()->subDays(count($projects) - $index),
            ]);
        }
    }

    /**
     * Seed the professional experience timeline.
     */
    private function seedExperience(): void
    {
        $experiences = [
            [
                'role' => 'Senior Full Stack Developer',
                'company' => 'Acme Digital Agency',
                'company_url' => 'https://example.com',
                'location' => 'Remote',
                'type' => 'full-time',
                'description' => 'Leading development of client-facing products spanning Laravel APIs and Nuxt frontends. Introducing repository patterns, automated testing and CI/CD to reduce regression risk.',
                'technologies' => ['Laravel', 'Nuxt', 'Vue', 'Docker', 'MySQL'],
                'start_date' => '2023-04-01',
                'end_date' => null,
                'current' => true,
                'sort_order' => 0,
            ],
            [
                'role' => 'Full Stack Web Developer',
                'company' => 'Brightbox Studio',
                'company_url' => 'https://example.com',
                'location' => 'London, UK',
                'type' => 'full-time',
                'description' => 'Shipped e-commerce and marketing sites for international brands. Built custom WordPress themes and WooCommerce plugins, and migrated legacy systems to Laravel APIs consumed by Vue frontends.',
                'technologies' => ['WordPress', 'WooCommerce', 'Laravel', 'Vue', 'cPanel'],
                'start_date' => '2021-01-01',
                'end_date' => '2023-03-31',
                'current' => false,
                'sort_order' => 1,
            ],
            [
                'role' => 'PHP / Laravel Developer',
                'company' => 'Novalabs',
                'company_url' => 'https://example.com',
                'location' => 'Manchester, UK',
                'type' => 'full-time',
                'description' => 'Developed REST APIs and internal tools on Laravel. Improved database query performance, added unit and feature test coverage, and managed deployments on Linux servers with Nginx.',
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'Redis', 'Linux', 'Nginx'],
                'start_date' => '2019-06-01',
                'end_date' => '2020-12-31',
                'current' => false,
                'sort_order' => 2,
            ],
            [
                'role' => 'WordPress Developer',
                'company' => 'Freelance',
                'company_url' => null,
                'location' => 'Remote',
                'type' => 'freelance',
                'description' => 'Designed and built custom WordPress sites for small businesses, including theme development, WooCommerce stores, SEO optimisation and ongoing maintenance and security hardening.',
                'technologies' => ['WordPress', 'Elementor', 'WPBakery', 'WooCommerce'],
                'start_date' => '2018-01-01',
                'end_date' => '2019-05-31',
                'current' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::updateOrCreate(
                ['role' => $experience['role'], 'company' => $experience['company']],
                $experience,
            );
        }
    }

    /**
     * Seed a couple of sample contact messages.
     */
    private function seedContacts(): void
    {
        Contact::updateOrCreate(
            ['email' => 'recruiter@example.com'],
            [
                'name' => 'Sarah Recruiter',
                'email' => 'recruiter@example.com',
                'subject' => 'Frontend role at Example Co',
                'message' => 'We are looking for a Nuxt developer to join our product team. Your portfolio looks like a great fit for the role.',
                'status' => ContactStatus::Read,
            ],
        );
    }
}
