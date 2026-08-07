import type { Project } from '~/types/portfolio'

/**
 * Static portfolio projects.
 * Mirrors the data seeded in the backend PortfolioSeeder so the Projects
 * section always renders content, even without a deployed API.
 */
export const projects: Project[] = [
  {
    id: 1,
    title: 'Custom WordPress Plugin',
    slug: 'custom-wordpress-plugin',
    summary:
      'A production WordPress plugin with custom database tables, a settings UI and scheduled background tasks.',
    description:
      'A custom WordPress plugin built for a client on shared hosting. Adds bespoke features on top of WordPress with a clean settings page, custom database tables and WP-Cron scheduled jobs. Follows WordPress coding standards, escapes and validates all output, and stays compatible across several WordPress major versions.',
    thumbnail: '/images/projects/custom-wordpress-plugin.svg',
    github_url: 'https://github.com/yourusername/custom-wordpress-plugin',
    live_url: 'https://example.com',
    featured: true,
    technologies: ['WordPress', 'PHP', 'MySQL', 'WP-CLI'],
    gallery: ['/images/projects/custom-wordpress-plugin.svg'],
    challenges: [
      'Keeping the plugin compatible across multiple WordPress major versions.',
      'Running scheduled jobs within the memory and time limits of shared hosting.',
    ],
    features: [
      'Custom settings admin page',
      'Custom database tables',
      'WP-Cron scheduled background tasks',
    ],
    published_at: '2026-08-01',
  },
  {
    id: 2,
    title: 'WooCommerce Store Development',
    slug: 'woocommerce-store-development',
    summary:
      'A complete WooCommerce store with custom product types, flexible shipping rules and optimised checkout.',
    description:
      'A fully customised WooCommerce store for a retail business. Includes custom product types, conditional shipping rules based on cart contents and customer location, and a streamlined checkout that reduced cart abandonment. Wrapped in a lightweight custom theme with no page-builder bloat.',
    thumbnail: '/images/projects/woocommerce-store.svg',
    github_url: 'https://github.com/yourusername/woocommerce-store-development',
    live_url: 'https://example.com',
    featured: true,
    technologies: ['WordPress', 'WooCommerce', 'PHP', 'MySQL'],
    gallery: ['/images/projects/woocommerce-store.svg'],
    challenges: [
      'Building conditional shipping rules without slowing down cart calculations.',
      'Keeping the checkout fast and compliant with payment gateway requirements.',
    ],
    features: [
      'Custom product types',
      'Conditional shipping rules engine',
      'Optimised one-page checkout',
    ],
    published_at: '2026-07-15',
  },
  {
    id: 3,
    title: 'WordPress Malware Scanner',
    slug: 'wordpress-malware-scanner',
    summary:
      'A WordPress security plugin that fingerprints core files and scans for known malware signatures.',
    description:
      'A security-focused WordPress plugin that hashes core, theme and plugin files, detects modified files and scans for common malware signatures. Provides one-click cleanup reports and scheduled scans via WP-Cron. Built to run reliably on budget shared hosting.',
    thumbnail: '/images/projects/wordpress-malware-scanner.svg',
    github_url: 'https://github.com/yourusername/wordpress-malware-scanner',
    live_url: 'https://example.com',
    featured: true,
    technologies: ['WordPress', 'PHP', 'MySQL'],
    gallery: ['/images/projects/wordpress-malware-scanner.svg'],
    challenges: [
      'Scanning thousands of files within PHP memory and execution limits.',
      'Avoiding false positives from legitimately customised themes.',
    ],
    features: [
      'File hash integrity checker',
      'Signature-based malware detection',
      'Scheduled background scans',
    ],
    published_at: '2026-07-01',
  },
  {
    id: 4,
    title: 'Website Migration Project',
    slug: 'website-migration-project',
    summary:
      'A zero-downtime migration of a high-traffic WordPress site to a new host with live DNS cutover.',
    description:
      'Migrated a high-traffic WordPress site between hosts with zero downtime. Transferred files and database, moved DNS gradually, updated hard-coded URLs, and verified every plugin and form still worked after cutover. Included a full rollback plan and post-migration performance checks.',
    thumbnail: '/images/projects/website-migration.svg',
    github_url: null,
    live_url: 'https://example.com',
    featured: false,
    technologies: ['WordPress', 'cPanel', 'Linux', 'DNS'],
    gallery: ['/images/projects/website-migration.svg'],
    challenges: [
      'Planning a live DNS cutover without downtime or data loss.',
      'Preserving file permissions, email routing and cron jobs across hosts.',
    ],
    features: [
      'Zero-downtime cutover plan',
      'URL and database search-and-replace',
      'Post-migration verification checklist',
    ],
    published_at: '2026-06-10',
  },
  {
    id: 5,
    title: 'WordPress Performance Optimization',
    slug: 'wordpress-performance-optimization',
    summary:
      'A full performance audit and optimization that took a WordPress site from slow to near-instant.',
    description:
      'Audited a WordPress site scoring poorly on Core Web Vitals and turned it around. Removed render-blocking assets, implemented caching, optimised images and database, and trimmed third-party scripts. Final result: 90+ PageSpeed scores on mobile while preserving functionality.',
    thumbnail: '/images/projects/performance-optimization.svg',
    github_url: null,
    live_url: 'https://example.com',
    featured: false,
    technologies: ['WordPress', 'PHP', 'MySQL', 'Nginx'],
    gallery: ['/images/projects/performance-optimization.svg'],
    challenges: [
      'Improving load times without breaking third-party features.',
      'Squeezing performance gains out of a modest shared-hosting plan.',
    ],
    features: [
      'Core Web Vitals audit',
      'Page caching and asset optimisation',
      'Database cleanup and image compression',
    ],
    published_at: '2026-05-20',
  },
  {
    id: 6,
    title: 'Hosting & Server Management',
    slug: 'hosting-server-management',
    summary:
      'Ongoing management of WordPress hosting environments including security, backups and uptime monitoring.',
    description:
      'Day-to-day administration of WordPress hosting environments for client websites. Handles SSL certificates, security hardening, automated backups, uptime monitoring and emergency recovery. Keeps core, themes and plugins updated with careful staging and rollback.',
    thumbnail: '/images/projects/hosting-management.svg',
    github_url: null,
    live_url: 'https://example.com',
    featured: false,
    technologies: ['cPanel', 'Linux', 'SSL', 'DNS'],
    gallery: ['/images/projects/hosting-management.svg'],
    challenges: [
      'Recovering sites quickly after failures or hack attempts.',
      'Rolling out updates without breaking live functionality.',
    ],
    features: [
      'Automated backups and restores',
      'Security hardening and malware cleanup',
      'Uptime monitoring with rapid response',
    ],
    published_at: '2026-04-25',
  },
]
