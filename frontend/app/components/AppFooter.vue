<script setup lang="ts">
import { about } from '~/data/about'

defineOptions({ name: 'AppFooter' })

const year = new Date().getFullYear()

const navLinks = [
  { label: 'About', to: '#about' },
  { label: 'Skills', to: '#skills' },
  { label: 'Experience', to: '#experience' },
  { label: 'Contact', to: '#contact' },
]

const email = computed(() => about.email)

const socials = computed(() => [
  { name: 'GitHub', href: about.social.github ?? 'https://github.com/yourusername', icon: 'lucide:github' },
  { name: 'LinkedIn', href: about.social.linkedin ?? 'https://linkedin.com/in/yourusername', icon: 'lucide:linkedin' },
  { name: 'Facebook', href: about.social.facebook ?? 'https://facebook.com/yourusername', icon: 'lucide:facebook' },
  { name: 'Email', href: `mailto:${email.value}`, icon: 'lucide:mail' },
])
</script>

<template>
  <footer class="relative z-10 border-t border-[color:var(--color-border)]">
    <div class="container-page">
      <div class="grid gap-12 py-14 md:grid-cols-12 md:gap-8">
        <div class="md:col-span-5">
          <div class="flex items-center gap-3">
            <span
              class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-emerald-400 font-display text-sm font-bold text-white"
            >
              FI
            </span>
            <span class="font-display text-base font-semibold tracking-tight">
              Francis Ian
              <span class="text-gradient">.</span>
            </span>
          </div>
          <p class="mt-4 max-w-sm text-sm leading-relaxed text-[color:var(--color-muted)]">
            WordPress developer building fast, secure and maintainable websites — from custom themes
            and plugins to WooCommerce stores and hosting.
          </p>
          <ul class="mt-6 flex items-center gap-3" aria-label="Social links">
            <li v-for="social in socials" :key="social.name">
              <a
                :href="social.href"
                target="_blank"
                rel="noopener noreferrer"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-[color:var(--color-border)] text-[color:var(--color-muted)] transition-all duration-300 hover:-translate-y-0.5 hover:border-blue-400/50 hover:text-white hover:shadow-glow-sm"
                :aria-label="`Visit ${social.name}`"
              >
                <Icon :name="social.icon" :size="18" aria-hidden="true" />
              </a>
            </li>
          </ul>
        </div>

        <div class="md:col-span-3">
          <p class="mb-4 text-xs font-semibold uppercase tracking-[0.2em] text-blue-400">
            Navigate
          </p>
          <ul class="space-y-2.5">
            <li v-for="link in navLinks" :key="link.to">
              <a
                :href="link.to"
                class="text-sm text-[color:var(--color-muted)] transition-colors hover:text-white"
              >
                {{ link.label }}
              </a>
            </li>
          </ul>
        </div>

        <div class="md:col-span-4">
          <p class="mb-4 text-xs font-semibold uppercase tracking-[0.2em] text-blue-400">
            Get in touch
          </p>
          <ul class="space-y-3 text-sm">
            <li>
              <a
                :href="`mailto:${email}`"
                class="flex items-center gap-3 text-[color:var(--color-muted)] transition-colors hover:text-white"
              >
                <Icon name="lucide:mail" :size="16" class="text-blue-400" aria-hidden="true" />
                {{ email }}
              </a>
            </li>
            <li
              v-if="about?.location"
              class="flex items-center gap-3 text-[color:var(--color-muted)]"
            >
              <Icon name="lucide:map-pin" :size="16" class="text-blue-400" aria-hidden="true" />
              {{ about.location }}
            </li>
            <li class="flex items-center gap-3 text-[color:var(--color-muted)]">
              <span class="relative flex h-2 w-2">
                <span
                  class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"
                />
                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400" />
              </span>
              Available for work
            </li>
          </ul>
        </div>
      </div>

      <div
        class="flex flex-col items-center justify-between gap-3 border-t border-[color:var(--color-border)] py-6 sm:flex-row"
      >
        <p class="text-xs text-[color:var(--color-muted)]">
          © {{ year }} Francis Ian. All rights reserved.
        </p>
        <p class="text-xs text-[color:var(--color-muted)]">
          Built with Nuxt 4 · Laravel 12 · Tailwind CSS
        </p>
      </div>
    </div>
  </footer>
</template>
