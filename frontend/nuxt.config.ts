// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  compatibilityDate: '2025-07-15',

  // SPA (client-side rendering) — no server-side rendering.
  ssr: false,

  devtools: { enabled: true },

  modules: [
    '@nuxtjs/tailwindcss',
    '@pinia/nuxt',
    '@vueuse/nuxt',
    '@nuxt/icon',
    '@nuxtjs/color-mode',
    '@nuxtjs/robots',
    '@nuxtjs/sitemap',
    '@nuxt/eslint',
  ],

  css: ['~/assets/css/main.css'],

  components: [{ path: '~/components', pathPrefix: false }],

  tailwindcss: {
    cssPath: '~/assets/css/main.css',
  },

  runtimeConfig: {
    backendUrl: process.env.NUXT_BACKEND_URL || 'http://localhost:8000',
    public: {
      apiBase: process.env.NUXT_PUBLIC_API_BASE || '/api/v1',
      siteUrl: process.env.NUXT_PUBLIC_SITE_URL || 'http://localhost:3000',
      siteName: 'Francis Ian — WordPress Developer',
    },
  },

  colorMode: {
    classSuffix: '',
    preference: 'dark',
    fallback: 'dark',
    storageKey: 'portfolio-color-mode',
  },

  icon: {
    serverBundle: {
      collections: ['lucide', 'devicon', 'simple-icons'],
    },
  },

  app: {
    head: {
      htmlAttrs: {
        lang: 'en',
        class: 'dark',
      },
      titleTemplate: '%s | WordPress Developer',
      meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { name: 'theme-color', content: '#0f172a' },
        { name: 'format-detection', content: 'telephone=no' },
        {
          name: 'description',
          content:
            'Portfolio of Francis Ian, a WordPress developer specialising in custom themes, plugins, WooCommerce stores, migrations and performance optimization.',
        },
        { name: 'og:type', content: 'website' },
        { name: 'og:site_name', content: 'WordPress Developer Portfolio' },
        { name: 'twitter:card', content: 'summary_large_image' },
      ],
      link: [{ rel: 'icon', type: 'image/svg+xml', href: '/favicon.svg' }],
    },
    pageTransition: {
      name: 'page',
      mode: 'out-in',
    },
  },

  typescript: {
    strict: true,
    typeCheck: true,
  },

  sitemap: {
    enabled: true,
    autoLastmod: true,
  },

  robots: {
    enabled: true,
    disallow: ['/admin'],
  },

  routeRules: {
    '/images/**': { headers: { 'Cache-Control': 'public, max-age=31536000, immutable' } },
  },
})
