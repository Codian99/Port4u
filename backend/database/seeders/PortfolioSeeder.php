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
use Illuminate\Support\Carbon;

class PortfolioSeeder extends Seeder
{
    /**
     * Seed the portfolio demo data.
     */
    public function run(): void
    {
        // Seed the portfolio content only on a fresh database so container
        // restarts don't shift publish dates or reset edited rows.
        if (Project::query()->exists()) {
            return;
        }

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
            'wordpress' => [
                'name' => 'WordPress',
                'icon' => 'devicon:wordpress',
                'skills' => [
                    ['name' => 'WordPress Core', 'level' => 95, 'icon' => 'devicon:wordpress'],
                    ['name' => 'PHP', 'level' => 93, 'icon' => 'devicon:php'],
                    ['name' => 'Custom Theme Development', 'level' => 92, 'icon' => 'lucide:paintbrush'],
                    ['name' => 'Custom Plugin Development', 'level' => 90, 'icon' => 'lucide:puzzle'],
                    ['name' => 'Gutenberg / Block Editor', 'level' => 88, 'icon' => 'lucide:layout-template'],
                    ['name' => 'Advanced Custom Fields (ACF)', 'level' => 85, 'icon' => 'lucide:form-input'],
                ],
            ],
            'woocommerce' => [
                'name' => 'WooCommerce',
                'icon' => 'devicon:woocommerce',
                'skills' => [
                    ['name' => 'WooCommerce Development', 'level' => 90, 'icon' => 'lucide:shopping-cart'],
                    ['name' => 'Custom Shipping Rules', 'level' => 85, 'icon' => 'lucide:truck'],
                    ['name' => 'Payment Gateway Integration', 'level' => 84, 'icon' => 'lucide:credit-card'],
                    ['name' => 'Product Catalog Management', 'level' => 88, 'icon' => 'lucide:package'],
                ],
            ],
            'frontend' => [
                'name' => 'Frontend & UI',
                'icon' => 'lucide:monitor',
                'skills' => [
                    ['name' => 'HTML5 & CSS3', 'level' => 95, 'icon' => 'devicon:html5'],
                    ['name' => 'Responsive Web Design', 'level' => 94, 'icon' => 'lucide:smartphone'],
                    ['name' => 'JavaScript', 'level' => 90, 'icon' => 'devicon:javascript'],
                    ['name' => 'jQuery', 'level' => 86, 'icon' => 'devicon:jquery'],
                    ['name' => 'Tailwind CSS', 'level' => 84, 'icon' => 'devicon:tailwindcss'],
                    ['name' => 'Vue.js', 'level' => 80, 'icon' => 'devicon:vuejs'],
                ],
            ],
            'hosting' => [
                'name' => 'Hosting & DevOps',
                'icon' => 'lucide:server',
                'skills' => [
                    ['name' => 'cPanel / WHM', 'level' => 92, 'icon' => 'simple-icons:cpanel'],
                    ['name' => 'Website Migration & Deployment', 'level' => 90, 'icon' => 'lucide:arrow-left-right'],
                    ['name' => 'Linux Server Administration', 'level' => 86, 'icon' => 'devicon:linux'],
                    ['name' => 'Nginx & Apache', 'level' => 84, 'icon' => 'devicon:nginx'],
                    ['name' => 'SSL, DNS & Website Security', 'level' => 88, 'icon' => 'lucide:shield-check'],
                    ['name' => 'Domain & DNS Management', 'level' => 87, 'icon' => 'lucide:network'],
                ],
            ],
            'tools' => [
                'name' => 'Tools & Workflow',
                'icon' => 'lucide:wrench',
                'skills' => [
                    ['name' => 'Git & GitHub', 'level' => 90, 'icon' => 'devicon:git'],
                    ['name' => 'WP-CLI', 'level' => 86, 'icon' => 'lucide:square-terminal'],
                    ['name' => 'MySQL / MariaDB', 'level' => 88, 'icon' => 'devicon:mysql'],
                    ['name' => 'SEO & Google Search Console', 'level' => 84, 'icon' => 'lucide:search'],
                    ['name' => 'Composer', 'level' => 80, 'icon' => 'devicon:composer'],
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

            // Keyed by sort_order so renamed skills update in place
            // instead of creating duplicates on a re-seed.
            foreach ($data['skills'] as $skillIndex => $skill) {
                Skill::updateOrCreate(
                    ['category_id' => $category->id, 'sort_order' => $skillIndex],
                    ['name' => $skill['name'], 'level' => $skill['level'], 'icon' => $skill['icon']],
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
                'title' => 'Custom WordPress Plugin',
                'slug' => 'custom-wordpress-plugin',
                'summary' => 'A production WordPress plugin with custom database tables, a settings UI and scheduled background tasks.',
                'description' => 'A custom WordPress plugin built for a client on shared hosting. Adds bespoke features on top of WordPress with a clean settings page, custom database tables and WP-Cron scheduled jobs. Follows WordPress coding standards, escapes and validates all output, and stays compatible across several WordPress major versions.',
                'thumbnail' => '/images/projects/custom-wordpress-plugin.svg',
                'github' => 'https://github.com/yourusername/custom-wordpress-plugin',
                'live' => 'https://example.com',
                'featured' => true,
                'technologies' => ['WordPress', 'PHP', 'MySQL', 'WP-CLI'],
                'gallery' => ['/images/projects/custom-wordpress-plugin.svg'],
                'challenges' => [
                    'Keeping the plugin compatible across multiple WordPress major versions.',
                    'Running scheduled jobs within the memory and time limits of shared hosting.',
                ],
                'features' => [
                    'Custom settings admin page',
                    'Custom database tables',
                    'WP-Cron scheduled background tasks',
                ],
            ],
            [
                'title' => 'WooCommerce Store Development',
                'slug' => 'woocommerce-store-development',
                'summary' => 'A complete WooCommerce store with custom product types, flexible shipping rules and optimised checkout.',
                'description' => 'A fully customised WooCommerce store for a retail business. Includes custom product types, conditional shipping rules based on cart contents and customer location, and a streamlined checkout that reduced cart abandonment. Wrapped in a lightweight custom theme with no page-builder bloat.',
                'thumbnail' => '/images/projects/woocommerce-store.svg',
                'github' => 'https://github.com/yourusername/woocommerce-store-development',
                'live' => 'https://example.com',
                'featured' => true,
                'technologies' => ['WordPress', 'WooCommerce', 'PHP', 'MySQL'],
                'gallery' => ['/images/projects/woocommerce-store.svg'],
                'challenges' => [
                    'Building conditional shipping rules without slowing down cart calculations.',
                    'Keeping the checkout fast and compliant with payment gateway requirements.',
                ],
                'features' => [
                    'Custom product types',
                    'Conditional shipping rules engine',
                    'Optimised one-page checkout',
                ],
            ],
            [
                'title' => 'WordPress Malware Scanner',
                'slug' => 'wordpress-malware-scanner',
                'summary' => 'A WordPress security plugin that fingerprints core files and scans for known malware signatures.',
                'description' => 'A security-focused WordPress plugin that hashes core, theme and plugin files, detects modified files and scans for common malware signatures. Provides one-click cleanup reports and scheduled scans via WP-Cron. Built to run reliably on budget shared hosting.',
                'thumbnail' => '/images/projects/wordpress-malware-scanner.svg',
                'github' => 'https://github.com/yourusername/wordpress-malware-scanner',
                'live' => 'https://example.com',
                'featured' => true,
                'technologies' => ['WordPress', 'PHP', 'MySQL'],
                'gallery' => ['/images/projects/wordpress-malware-scanner.svg'],
                'challenges' => [
                    'Scanning thousands of files within PHP memory and execution limits.',
                    'Avoiding false positives from legitimately customised themes.',
                ],
                'features' => [
                    'File hash integrity checker',
                    'Signature-based malware detection',
                    'Scheduled background scans',
                ],
            ],
            [
                'title' => 'Website Migration Project',
                'slug' => 'website-migration-project',
                'summary' => 'A zero-downtime migration of a high-traffic WordPress site to a new host with live DNS cutover.',
                'description' => 'Migrated a high-traffic WordPress site between hosts with zero downtime. Transferred files and database, moved DNS gradually, updated hard-coded URLs, and verified every plugin and form still worked after cutover. Included a full rollback plan and post-migration performance checks.',
                'thumbnail' => '/images/projects/website-migration.svg',
                'github' => null,
                'live' => 'https://example.com',
                'featured' => false,
                'technologies' => ['WordPress', 'cPanel', 'Linux', 'DNS'],
                'gallery' => ['/images/projects/website-migration.svg'],
                'challenges' => [
                    'Planning a live DNS cutover without downtime or data loss.',
                    'Preserving file permissions, email routing and cron jobs across hosts.',
                ],
                'features' => [
                    'Zero-downtime cutover plan',
                    'URL and database search-and-replace',
                    'Post-migration verification checklist',
                ],
            ],
            [
                'title' => 'WordPress Performance Optimization',
                'slug' => 'wordpress-performance-optimization',
                'summary' => 'A full performance audit and optimization that took a WordPress site from slow to near-instant.',
                'description' => 'Audited a WordPress site scoring poorly on Core Web Vitals and turned it around. Removed render-blocking assets, implemented caching, optimised images and database, and trimmed third-party scripts. Final result: 90+ PageSpeed scores on mobile while preserving functionality.',
                'thumbnail' => '/images/projects/performance-optimization.svg',
                'github' => null,
                'live' => 'https://example.com',
                'featured' => false,
                'technologies' => ['WordPress', 'PHP', 'MySQL', 'Nginx'],
                'gallery' => ['/images/projects/performance-optimization.svg'],
                'challenges' => [
                    'Improving load times without breaking third-party features.',
                    'Squeezing performance gains out of a modest shared-hosting plan.',
                ],
                'features' => [
                    'Core Web Vitals audit',
                    'Page caching and asset optimisation',
                    'Database cleanup and image compression',
                ],
            ],
            [
                'title' => 'Hosting & Server Management',
                'slug' => 'hosting-server-management',
                'summary' => 'Ongoing management of WordPress hosting environments including security, backups and uptime monitoring.',
                'description' => 'Day-to-day administration of WordPress hosting environments for client websites. Handles SSL certificates, security hardening, automated backups, uptime monitoring and emergency recovery. Keeps core, themes and plugins updated with careful staging and rollback.',
                'thumbnail' => '/images/projects/hosting-management.svg',
                'github' => null,
                'live' => 'https://example.com',
                'featured' => false,
                'technologies' => ['cPanel', 'Linux', 'SSL', 'DNS'],
                'gallery' => ['/images/projects/hosting-management.svg'],
                'challenges' => [
                    'Recovering sites quickly after failures or hack attempts.',
                    'Rolling out updates without breaking live functionality.',
                ],
                'features' => [
                    'Automated backups and restores',
                    'Security hardening and malware cleanup',
                    'Uptime monitoring with rapid response',
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
                'published_at' => Carbon::parse('2026-06-01')->subDays($index),
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
                'role' => 'WordPress Developer',
                'company' => 'Pageone247',
                'company_url' => 'https://www.pageone247.com/',
                'location' => 'Remote',
                'type' => 'full-time',
                'description' => 'Developing and maintaining WordPress websites at Pageone247 — building custom themes and plugins, WooCommerce stores and performance optimisations for client projects.',
                'technologies' => ['WordPress', 'WooCommerce', 'PHP', 'MySQL'],
                'start_date' => '2026-01-01',
                'end_date' => null,
                'current' => true,
                'sort_order' => 0,
            ],
            [
                'role' => 'WordPress Developer',
                'company' => 'Freelance',
                'company_url' => null,
                'location' => 'Remote',
                'type' => 'freelance',
                'description' => 'Designed and built custom WordPress sites for small businesses, including theme development, WooCommerce stores, SEO optimisation and ongoing maintenance and security hardening.',
                'technologies' => ['WordPress', 'WooCommerce', 'Elementor', 'WPBakery'],
                'start_date' => '2025-01-01',
                'end_date' => '2025-12-31',
                'current' => false,
                'sort_order' => 1,
            ],
            [
                'role' => 'WordPress Support & Maintenance',
                'company' => 'Freelance',
                'company_url' => null,
                'location' => 'Remote',
                'type' => 'freelance',
                'description' => 'Provided ongoing WordPress support for client websites — updates, backups, security hardening, troubleshooting and recovery. Built a reputation for fixing broken sites fast and reliably.',
                'technologies' => ['WordPress', 'cPanel', 'SSL', 'DNS'],
                'start_date' => '2024-01-01',
                'end_date' => '2024-12-31',
                'current' => false,
                'sort_order' => 2,
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
                'subject' => 'WordPress developer role at Example Co',
                'message' => 'We are looking for a WordPress developer to lead our client projects. Your portfolio looks like a great fit for the role.',
                'status' => ContactStatus::Read,
            ],
        );
    }
}
