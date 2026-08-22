import type { ExperienceItem } from '~/types/portfolio'

/**
 * Static experience timeline.
 * Mirrors the data seeded in the backend PortfolioSeeder so the Experience
 * section always renders content, even without a deployed API.
 */
export const experiences: ExperienceItem[] = [
  {
    id: 1,
    role: 'WordPress Developer',
    company: 'Pageone247',
    company_url: 'https://www.pageone247.com/',
    location: 'Remote',
    type: 'full-time',
    description:
      'Developing and maintaining WordPress websites at Pageone247 — building custom themes and plugins, WooCommerce stores and performance optimisations for client projects.',
    technologies: ['WordPress', 'WooCommerce', 'PHP', 'MySQL'],
    start_date: '2026-01-01',
    end_date: null,
    current: true,
  },
  {
    id: 2,
    role: 'WordPress Developer',
    company: 'Freelance',
    company_url: null,
    location: 'Remote',
    type: 'freelance',
    description:
      'Designed and built custom WordPress sites for small businesses, including theme development, WooCommerce stores, SEO optimisation and ongoing maintenance and security hardening.',
    technologies: ['WordPress', 'WooCommerce', 'Elementor', 'WPBakery'],
    start_date: '2025-01-01',
    end_date: '2025-12-31',
    current: false,
  },
  {
    id: 3,
    role: 'WordPress Support & Maintenance',
    company: 'Freelance',
    company_url: null,
    location: 'Remote',
    type: 'freelance',
    description:
      'Provided ongoing WordPress support for client websites — updates, backups, security hardening, troubleshooting and recovery. Built a reputation for fixing broken sites fast and reliably.',
    technologies: ['WordPress', 'cPanel', 'SSL', 'DNS'],
    start_date: '2024-01-01',
    end_date: '2024-12-31',
    current: false,
  },
]
