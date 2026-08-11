import type { AboutProfile } from '~/types/portfolio'

/**
 * Static profile data.
 * Mirrors the backend `config/portfolio.php` so the site works without a deployed API.
 */
export const about: AboutProfile = {
  name: 'Francis Ian',
  title: 'WordPress Developer',
  tagline:
    'I design, build and maintain fast, secure WordPress websites that grow with your business.',
  summary:
    'WordPress Developer with hands-on experience building custom themes and plugins, WooCommerce stores, and performance optimizations for production websites. Experienced with migrations, hosting environments and troubleshooting across Linux servers.',
  email: 'francisian172@gmail.com',
  location: 'Remote · Worldwide',
  avatar: '/images/avatar.jpg',
  resume_url: '/files/Francis%20ian.png',
  availability: true,
  social: {
    github: 'https://github.com/yourusername',
    linkedin: 'https://linkedin.com/in/yourusername',
    facebook: 'https://facebook.com/yourusername',
  },
  highlights: [],
  education: [
    {
      degree: 'BSc Computer Science',
      school: 'University of Technology',
      period: '2014 - 2018',
      description: 'Focused on software engineering, databases and web technologies.',
    },
    {
      degree: 'WordPress Development Certification',
      school: 'Online Bootcamp',
      period: '2017 - 2018',
      description:
        'Intensive programme covering PHP, WordPress APIs, custom theming and plugin architecture.',
    },
  ],
}
