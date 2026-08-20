# Changelog

All notable changes to the portfolio project.

## [1.5.2] - 2026-08-20 — Contact section side-by-side layout

### Changed
- **Contact section**: reverted to single centered card with contact details only (form removed).

## [1.5.1] - 2026-08-20 — Remove Education section

### Removed
- **Education section** from the homepage: the "Where I learned the craft" block (`AppSectionTitle` + `AppTimeline`) at the end of the `#about` section in `pages/index.vue`. It rendered placeholder school/degree data and was the frontend's only consumer of `about.education`.

### Notes
- `AppTimeline` is unchanged and still used by the Experience section.
- The `education` field is intentionally kept in `frontend/app/data/about.ts`, the `AboutProfile`/`EducationItem` types and the backend `/api/v1/about` payload (`config/portfolio.php`) — it is simply no longer rendered. Removing it from the API contract would be a separate breaking change.
- No navbar, scroll-spy or SEO changes were needed: the block lived entirely inside `#about` and had no menu entry of its own.

### Verified
- Frontend: `npm run typecheck`, `npm run lint` and `npm run build` all pass.

## [1.5.0] - 2026-08-15 — Bug fixes, light theme and content updates

### Added
- **Light theme**: full light palette (`html.light` CSS variables in `main.css`), a light `.glass` navbar variant and theme-adaptive hover/text colors across the navbar, footer, drawer, modal, buttons and badges. The navbar theme toggle now actually switches between dark and light.
- **Backend entrypoint** (`docker/backend/entrypoint.sh`): generates and persists `APP_KEY` on first boot when the environment provides none, then caches config/routes, runs migrations and seeds. The backend image now uses this as its `ENTRYPOINT`.
- **Experience**: "WordPress Developer at Pageone247" (`https://www.pageone247.com/`) since Jan 2025, marked "Current" — added to `frontend/app/data/experience.ts` and the backend `PortfolioSeeder`.

### Changed
- **Seeding is now first-boot only**: `DatabaseSeeder` creates the default admin only on an empty database, and `PortfolioSeeder` skips once projects exist. Container restarts no longer reset the admin password or shift seeded `published_at` dates; publish dates are now deterministic (fixed base date).
- **Trusted proxies**: `bootstrap/app.php` now trusts the nginx proxy (`trustProxies(at: '*')`) so rate limiting and request logging see real client IPs instead of nginx's container IP.
- **`backend/.env.example`**: `REDIS_CLIENT` fixed from `predis` to `phpredis` to match the PHP extension installed in the image.
- **`nuxt.config.ts`**: devtools are now enabled only outside production builds.
- **Error page**: the "Contact me" link now points to `/#contact` instead of the removed `/contact` route.
- **Branding**: site icon and brand mark rebranded to "POR" — favicon, navbar and footer monograms and the OG image.
- **Experience timeline**: removed the Acme Digital Agency (Senior WordPress Developer) and Brightbox Studio (WordPress Developer) roles from `frontend/app/data/experience.ts` and the backend `PortfolioSeeder` (kept in sync).

### Fixed
- `PortfolioApiTest` asserted 6 skill categories while the seeder creates 5 — now asserts 5 (the test was failing).
- Theme toggle previously had no visual effect because only a dark palette was defined.

### Verified
- Backend: 9 PHPUnit tests pass.
- Frontend: `npm run typecheck`, `npm run lint` and `npm run build` all pass.

## [1.4.0] - 2026-08-07 — Static frontend content

### Added
- Static content modules under `frontend/app/data/`: `about.ts`, `projects.ts`, `skills.ts`, `experience.ts`, mirroring the backend-seeded data.
- The About, Projects, Skills and Experience sections now render entirely from this static data — no deployed API required.

### Changed
- `pages/index.vue` and `AppFooter.vue` read from the static modules instead of `useApi()`.
- Removed the loading spinner from the Projects section (data is always present).

### Removed
- Frontend API calls for about, projects, skills and experience (the contact form still posts to `/api/v1/contact`).

### Verified
- `npm run typecheck`, `npm run lint` and `npm run build` all pass.

## [1.3.0] - 2026-08-07 — Premium hero redesign

### Added
- `HeroSection.vue`: two-column, mobile-first hero section.
  - Left: "Welcome to My Portfolio" badge, availability pill, "Building High-Performance WordPress Solutions" heading with blue gradient, subtitle, "View My Projects"/"Contact Me" CTAs, four glass stat chips and social links.
  - Right: glowing laptop mockup showing a WordPress dashboard, plus floating VS Code, Terminal (wp-cli) and cPanel glass windows and 12 floating tech cards (WordPress, PHP, WooCommerce, Elementor, WPBakery, Laravel, Docker, MySQL, REST API, Git, cPanel, Linux) with bundled brand logos.
  - Background: grid overlay, animated gradient blobs, drifting particles and a pulsing blue glow.
  - GSAP animations: staggered intro timeline, glow pulse, bouncing scroll indicator, scroll parallax (ScrollTrigger) and pointer parallax via `gsap.quickTo` with per-element `data-depth`. Fully disabled under `prefers-reduced-motion` and cleaned up on unmount.
- Installed `@iconify-json/lucide`, `@iconify-json/simple-icons` and `@iconify-json/devicon` so all icons (including brand logos) are bundled at build time instead of fetched at runtime.
- `main.css`: reduced-motion kill-switch for all CSS animations/transitions.

### Changed
- Navbar menu reordered to Home, About, Skills, Services, Projects, Contact; CTA relabeled "Hire Me".
- Old inline hero (typewriter terminal card) replaced with `<HeroSection />`; related dead code removed.

### Verified
- `npm run typecheck`, `npm run lint` and `npm run build` all pass; production server smoke-tested (HTTP 200).

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
