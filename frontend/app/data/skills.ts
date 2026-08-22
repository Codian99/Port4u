import type { SkillCategory } from '~/types/portfolio'

/**
 * Static skill categories and skills.
 * Mirrors the data seeded in the backend PortfolioSeeder so the Skills
 * section always renders content, even without a deployed API.
 *
 * Category order is intentional:
 * WordPress → WooCommerce → Frontend & UI → Hosting & DevOps → Tools & Workflow
 */
export const skillCategories: SkillCategory[] = [
  {
    id: 1,
    name: 'WordPress',
    slug: 'wordpress',
    icon: 'devicon:wordpress',
    skills: [
      { id: 1, name: 'WordPress Core', icon: 'devicon:wordpress' },
      { id: 2, name: 'PHP', icon: 'devicon:php' },
      { id: 3, name: 'Custom Theme Development', icon: 'lucide:paintbrush' },
      { id: 4, name: 'Custom Plugin Development', icon: 'lucide:puzzle' },
      { id: 5, name: 'Gutenberg / Block Editor', icon: 'lucide:layout-template' },
      { id: 6, name: 'Advanced Custom Fields (ACF)', icon: 'lucide:form-input' },
    ],
  },
  {
    id: 2,
    name: 'WooCommerce',
    slug: 'woocommerce',
    icon: 'devicon:woocommerce',
    skills: [
      { id: 7, name: 'WooCommerce Development', icon: 'lucide:shopping-cart' },
      { id: 8, name: 'Custom Shipping Rules', icon: 'lucide:truck' },
      { id: 9, name: 'Payment Gateway Integration', icon: 'lucide:credit-card' },
      { id: 10, name: 'Product Catalog Management', icon: 'lucide:package' },
    ],
  },
  {
    id: 3,
    name: 'Frontend & UI',
    slug: 'frontend',
    icon: 'lucide:monitor',
    skills: [
      { id: 11, name: 'HTML5 & CSS3', icon: 'devicon:html5' },
      { id: 12, name: 'Responsive Web Design', icon: 'lucide:smartphone' },
      { id: 13, name: 'JavaScript', icon: 'devicon:javascript' },
      { id: 14, name: 'jQuery', icon: 'devicon:jquery' },
      { id: 15, name: 'Tailwind CSS', icon: 'devicon:tailwindcss' },
      { id: 16, name: 'Vue.js', icon: 'devicon:vuejs' },
    ],
  },
  {
    id: 4,
    name: 'Hosting & DevOps',
    slug: 'hosting',
    icon: 'lucide:server',
    skills: [
      { id: 17, name: 'cPanel / WHM', icon: 'simple-icons:cpanel' },
      { id: 18, name: 'Website Migration & Deployment', icon: 'lucide:arrow-left-right' },
      { id: 19, name: 'Linux Server Administration', icon: 'devicon:linux' },
      { id: 20, name: 'Nginx & Apache', icon: 'devicon:nginx' },
      { id: 21, name: 'SSL, DNS & Website Security', icon: 'lucide:shield-check' },
      { id: 22, name: 'Domain & DNS Management', icon: 'lucide:network' },
    ],
  },
  {
    id: 5,
    name: 'Tools & Workflow',
    slug: 'tools',
    icon: 'lucide:wrench',
    skills: [
      { id: 23, name: 'Git & GitHub', icon: 'devicon:git' },
      { id: 24, name: 'WP-CLI', icon: 'lucide:square-terminal' },
      { id: 25, name: 'MySQL / MariaDB', icon: 'devicon:mysql' },
      { id: 26, name: 'SEO & Google Search Console', icon: 'lucide:search' },
      { id: 27, name: 'Composer', icon: 'devicon:composer' },
    ],
  },
]
