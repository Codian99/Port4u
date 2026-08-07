# Changelog

All notable changes to the portfolio project.

## [1.2.0] - 2026-08-07 — Single-page scroll navigation

### Added
- Scroll-spy in the navbar: the active tab highlights based on scroll position (`updateActiveSection`).
- Inline "Details" toggle on project cards showing features + challenges, replacing the separate detail pages.
- All sections (home, about, services, why, projects, skills, experience, contact) merged into a single homepage.

### Changed
- Navbar and footer links smooth-scroll to page anchors (`#home`, `#about`, `#projects`, `#skills`, `#experience`, `#contact`) instead of navigating to separate routes; the mobile drawer uses the same anchors.
- `nuxt.config.ts`: removed dynamic sitemap entries and the `/projects/**` SWR route rule (detail pages no longer exist); title template and metadata WordPress-branded; `theme-color` updated to the new background (`#0f172a`).

### Removed
- Pages: `about`, `skills`, `experience`, `contact`, `projects/index`, `projects/[slug]`, `blog/index`.
- Component: `PageHero`.

### Fixed
- Typecheck error in navbar scroll-spy (`sections[0]` possibly undefined under `noUncheckedIndexedAccess`).
- Lint error in `ProjectCard` (unused `props` variable).

### Verified
- `npm run typecheck`, `npm run lint` and `npm run build` all pass.

## [1.1.0] - 2026-08-07 — Rebrand to WordPress Developer

### Added
- "Services" and "Why Work With Me" sections on the homepage.
- Six new project thumbnail SVGs for the WordPress portfolio.
- Skill categories and bars covering WordPress, WooCommerce, Frontend & UI, Hosting & DevOps, Tools & Workflow.

### Changed
- Site identity: name "Francis Ian", role "WordPress Developer" (backend `config/portfolio.php` + `.env`, frontend metadata and title template).
- Theme palette: violet/fuchsia/cyan → blue/indigo/emerald.
- Backend `PortfolioSeeder`: 5 skill categories, 6 WordPress projects, WordPress-focused experience timeline, updated highlights and education.
- SEO description, `og:`/`twitter:` meta and sitemap branding updated for a WordPress developer focus.
- All page copy rewritten for the WordPress developer focus.

## [1.0.0] - 2026-08-06

### Added
- **Nuxt 4 frontend** (`frontend/`)
  - SSR app with Tailwind CSS, Pinia, VueUse, GSAP (scroll animations), `@nuxt/icon`, `@nuxtjs/color-mode`, robots + sitemap modules.
  - Pages: home, about, projects list + detail, skills, experience, contact, blog (structure-only), error.
  - Same-origin API proxy at `server/routes/api/[...path].ts` (browser + SSR call `/api/v1`, proxied to the backend — no CORS).
  - Reusable UI components under `app/components/` and `app/components/ui/`.
  - Dark theme, GSAP reveal directive, typewriter hero, project/OG images and favicon.
- **Laravel 12 backend** (`backend/`)
  - REST API under `/api/v1` with Sanctum auth.
  - Models, migrations and seeders for categories, skills, projects, experience and contacts.
  - Repository + service layer (Project, Skill, Experience, Contact) bound in `RepositoryServiceProvider`.
  - API resources, form request validation, throttled contact endpoint, portfolio profile config.
- **Docker stack**
  - `docker-compose.yml`: nginx + frontend + backend + MySQL 8.4 + Redis 7, healthchecks, named volumes.
  - Multi-stage frontend build (Node 22) and PHP 8.4 backend image with pdo_mysql, redis, intl, opcache, bcmath, mbstring, zip.
  - nginx reverse proxy: `/` → frontend, `/api/` → backend.
- **Root `README.md`** and this changelog.

### Fixed
- `ProjectResource` returned `description`/`gallery`/`challenges`/`features` conditionally, breaking the detail page (500 "Cannot read properties of undefined (reading 'split')"). Now returns all fields unconditionally.
- `Experience` model table name mismatch — `protected $table = 'experience'`.
- Nuxt `components/ui/*` were auto-registered with the `Ui` prefix (`UiAppBadge`) while templates used `<AppBadge>` — added `components: [{ path: '~/components', pathPrefix: false }]`.
- `AppTimeline` prop typing (`location?: string | null`).
- Frontend `package-lock.json` was Windows/npm 11 generated and missing Linux optional deps — regenerated on Linux so `npm ci` works in the container.
- Frontend Docker build ran `nuxt prepare` (via npm ci postinstall) before `nuxt.config.ts` was copied, producing stale `~/` path mappings — added an explicit `npx nuxt prepare` after the source copy.
- Backend Docker image was missing the PHP `redis` extension, breaking the throttled contact endpoint (`Class "Redis" not found`) — added `pecl install redis`.
- `DatabaseSeeder` used `User::factory()` which requires `fakerphp/faker` (absent with `--no-dev`) and would duplicate the admin on every seed — switched to `User::updateOrCreate` and removed the factory dependency.
- Removed prerender route rules that baked empty data into static pages during builds; `/projects/**` now uses SWR.

### Verified
- Backend: 9 PHPUnit tests pass, Pint clean, migrations + seed idempotent.
- Frontend: `npm run typecheck`, `npm run lint` and `npm run build` all clean.
- Docker stack: site, SSR content, API, contact form and 404 all verified end-to-end through nginx.
