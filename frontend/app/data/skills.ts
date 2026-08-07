import type { SkillCategory } from '~/types/portfolio'

/**
 * Static skill categories and skills.
 * Mirrors the data seeded in the backend PortfolioSeeder so the Skills
 * section always renders content, even without a deployed API.
 */
export const skillCategories: SkillCategory[] = [
  {
    id: 1,
    name: 'WordPress',
    slug: 'wordpress',
    icon: 'lucide:globe',
    skills: [
      { id: 1, name: 'WordPress Core', level: 95, icon: 'lucide:globe' },
      { id: 2, name: 'PHP', level: 93, icon: 'lucide:braces' },
      { id: 3, name: 'Custom Theme Development', level: 92, icon: 'lucide:paintbrush' },
      { id: 4, name: 'Custom Plugin Development', level: 90, icon: 'lucide:puzzle' },
      { id: 5, name: 'Gutenberg / Block Editor', level: 88, icon: 'lucide:layout-template' },
      { id: 6, name: 'ACF (Advanced Custom Fields)', level: 85, icon: 'lucide:file-type' },
    ],
  },
  {
    id: 2,
    name: 'WooCommerce',
    slug: 'woocommerce',
    icon: 'lucide:shopping-cart',
    skills: [
      { id: 7, name: 'WooCommerce Stores', level: 90, icon: 'lucide:shopping-cart' },
      { id: 8, name: 'Custom Shipping Rules', level: 85, icon: 'lucide:truck' },
      { id: 9, name: 'Payment Gateway Integration', level: 84, icon: 'lucide:credit-card' },
      { id: 10, name: 'Product Catalog Management', level: 88, icon: 'lucide:package' },
    ],
  },
  {
    id: 3,
    name: 'Frontend & UI',
    slug: 'frontend',
    icon: 'lucide:monitor',
    skills: [
      { id: 11, name: 'HTML5 & CSS3', level: 95, icon: 'lucide:code-2' },
      { id: 12, name: 'Responsive Design', level: 94, icon: 'lucide:smartphone' },
      { id: 13, name: 'JavaScript', level: 90, icon: 'lucide:file-code' },
      { id: 14, name: 'jQuery', level: 86, icon: 'lucide:code' },
      { id: 15, name: 'Tailwind CSS', level: 84, icon: 'lucide:palette' },
      { id: 16, name: 'Vue 3', level: 80, icon: 'lucide:atom' },
    ],
  },
  {
    id: 4,
    name: 'Hosting & DevOps',
    slug: 'hosting',
    icon: 'lucide:server',
    skills: [
      { id: 17, name: 'cPanel / WHM', level: 92, icon: 'lucide:layers' },
      { id: 18, name: 'Site Migrations', level: 90, icon: 'lucide:arrow-left-right' },
      { id: 19, name: 'Linux Administration', level: 86, icon: 'lucide:terminal' },
      { id: 20, name: 'Nginx & Apache', level: 84, icon: 'lucide:settings' },
      { id: 21, name: 'SSL & Security Hardening', level: 88, icon: 'lucide:shield-check' },
      { id: 22, name: 'DNS Management', level: 87, icon: 'lucide:network' },
    ],
  },
  {
    id: 5,
    name: 'Tools & Workflow',
    slug: 'tools',
    icon: 'lucide:wrench',
    skills: [
      { id: 23, name: 'Git & GitHub', level: 90, icon: 'lucide:git-branch' },
      { id: 24, name: 'WP-CLI', level: 86, icon: 'lucide:terminal-square' },
      { id: 25, name: 'MySQL', level: 88, icon: 'lucide:database' },
      { id: 26, name: 'Search Console & SEO', level: 84, icon: 'lucide:search' },
      { id: 27, name: 'Composer', level: 80, icon: 'lucide:package' },
    ],
  },
]
