<script setup lang="ts">
defineOptions({ name: 'AppFooter' })

const year = new Date().getFullYear()

const socials = [
  { name: 'GitHub', href: 'https://github.com/yourusername', icon: 'lucide:github' },
  { name: 'LinkedIn', href: 'https://linkedin.com/in/yourusername', icon: 'lucide:linkedin' },
  { name: 'Facebook', href: 'https://facebook.com/yourusername', icon: 'lucide:facebook' },
  { name: 'Email', href: 'mailto:francisian172@gmail.com', icon: 'lucide:mail' },
]
</script>

<template>
  <footer class="relative z-10 border-t border-[color:var(--color-border)]">
    <div
      class="container-page flex flex-col items-center gap-6 py-10 md:flex-row md:justify-between"
    >
      <p class="text-sm text-[color:var(--color-muted)]">
        © {{ year }} John Doe. All rights reserved.
      </p>

      <ul class="flex items-center gap-3" aria-label="Social links">
        <li v-for="social in socials" :key="social.name">
          <a
            :href="social.href"
            target="_blank"
            rel="noopener noreferrer"
            class="flex h-10 w-10 items-center justify-center rounded-lg border border-[color:var(--color-border)] text-[color:var(--color-muted)] transition-all duration-300 hover:-translate-y-0.5 hover:border-violet-400/50 hover:text-white"
            :aria-label="`Visit ${social.name}`"
          >
            <Icon :name="social.icon" :size="18" aria-hidden="true" />
          </a>
        </li>
      </ul>

      <p class="text-xs text-[color:var(--color-muted)]">
        Built with Nuxt 4 · Laravel 12 · Tailwind CSS
      </p>
    </div>
  </footer>
</template>
