import type { ExperienceItem } from '~/types/portfolio'

/**
 * Static experience timeline.
 * Mirrors the data seeded in the backend PortfolioSeeder so the Experience
 * section always renders content, even without a deployed API.
 */
export const experiences: ExperienceItem[] = [
  {
    id: 1,
    role: 'Senior WordPress Developer',
    company: 'Acme Digital Agency',
    company_url: 'https://example.com',
    location: 'Remote',
    type: 'full-time',
    description:
      'Leading WordPress projects for client websites. Building custom themes and plugins, running WooCommerce stores, and optimising performance and Core Web Vitals for production sites.',
    technologies: ['WordPress', 'WooCommerce', 'PHP', 'MySQL'],
    start_date: '2023-04-01',
    end_date: null,
    current: true,
  },
  {
    id: 2,
    role: 'WordPress Developer',
    company: 'Brightbox Studio',
    company_url: 'https://example.com',
    location: 'Remote',
    type: 'full-time',
    description:
      'Shipped marketing and e-commerce websites on WordPress for international brands. Built custom themes and WooCommerce plugins, performed site migrations, and managed hosting environments.',
    technologies: ['WordPress', 'WooCommerce', 'PHP', 'cPanel'],
    start_date: '2021-01-01',
    end_date: '2023-03-31',
    current: false,
  },
  {
    id: 3,
    role: 'WordPress Developer',
    company: 'Freelance',
    company_url: null,
    location: 'Remote',
    type: 'freelance',
    description:
      'Designed and built custom WordPress sites for small businesses, including theme development, WooCommerce stores, SEO optimisation and ongoing maintenance and security hardening.',
    technologies: ['WordPress', 'WooCommerce', 'Elementor', 'WPBakery'],
    start_date: '2019-06-01',
    end_date: '2020-12-31',
    current: false,
  },
  {
    id: 4,
    role: 'WordPress Support & Maintenance',
    company: 'Freelance',
    company_url: null,
    location: 'Remote',
    type: 'freelance',
    description:
      'Provided ongoing WordPress support for client websites — updates, backups, security hardening, troubleshooting and recovery. Built a reputation for fixing broken sites fast and reliably.',
    technologies: ['WordPress', 'cPanel', 'SSL', 'DNS'],
    start_date: '2018-01-01',
    end_date: '2019-05-31',
    current: false,
  },
]
