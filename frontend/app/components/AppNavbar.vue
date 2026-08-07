<script setup lang="ts">
defineOptions({ name: 'AppNavbar' })

const route = useRoute()
const colorMode = useColorMode()

const links = [
  { label: 'Home', to: '/' },
  { label: 'About', to: '/about' },
  { label: 'Projects', to: '/projects' },
  { label: 'Skills', to: '/skills' },
  { label: 'Experience', to: '/experience' },
  { label: 'Contact', to: '/contact' },
]

const scrolled = ref(false)
const mobileOpen = ref(false)

function isActive(link: { to: string }) {
  if (link.to === '/') return route.path === '/'
  return route.path.startsWith(link.to)
}

function onScroll() {
  scrolled.value = window.scrollY > 24
}

function closeMenu() {
  mobileOpen.value = false
}

watch(
  () => route.path,
  () => {
    closeMenu()
  }
)

onMounted(() => {
  onScroll()
  window.addEventListener('scroll', onScroll, { passive: true })
})

onBeforeUnmount(() => {
  window.removeEventListener('scroll', onScroll)
})

function toggleTheme() {
  colorMode.preference = colorMode.value === 'dark' ? 'light' : 'dark'
}
</script>

<template>
  <header
    class="fixed inset-x-0 top-0 z-40 transition-all duration-300"
    :class="scrolled ? 'glass shadow-lg shadow-black/30' : 'bg-transparent'"
  >
    <nav class="container-page flex h-[4.5rem] items-center justify-between" aria-label="Main navigation">
      <NuxtLink
        to="/"
        class="group flex items-center gap-3"
        aria-label="Go to homepage"
        @click="closeMenu"
      >
        <span
          class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-cyan-400 font-display text-sm font-bold text-white shadow-glow-sm transition-transform duration-300 group-hover:scale-105"
        >
          FI
        </span>
        <span class="hidden font-display text-base font-semibold tracking-tight sm:inline">
          Francis Ian
          <span class="text-gradient">.</span>
        </span>
      </NuxtLink>

      <ul class="hidden items-center gap-1 md:flex" role="menubar">
        <li v-for="link in links" :key="link.to" role="none">
          <NuxtLink
            :to="link.to"
            role="menuitem"
            class="relative rounded-lg px-3.5 py-2 text-sm font-medium transition-colors"
            :class="
              isActive(link) ? 'text-white' : 'text-[color:var(--color-muted)] hover:text-white'
            "
            :aria-current="isActive(link) ? 'page' : undefined"
          >
            {{ link.label }}
            <span
              class="absolute inset-x-3.5 -bottom-0.5 h-px bg-gradient-to-r from-violet-400 to-cyan-400 transition-transform duration-300"
              :class="isActive(link) ? 'scale-x-100' : 'scale-x-0'"
              aria-hidden="true"
            />
          </NuxtLink>
        </li>
      </ul>

      <div class="flex items-center gap-2">
        <button
          type="button"
          class="rounded-lg p-2 text-[color:var(--color-muted)] transition-colors hover:bg-white/5 hover:text-white"
          :aria-label="colorMode.value === 'dark' ? 'Switch to light mode' : 'Switch to dark mode'"
          @click="toggleTheme"
        >
          <Icon
            :name="colorMode.value === 'dark' ? 'lucide:sun' : 'lucide:moon'"
            :size="19"
            aria-hidden="true"
          />
        </button>

        <AppButton
          to="/contact"
          size="sm"
          class="hidden md:inline-flex"
          icon="lucide:send"
          icon-right
          @click="closeMenu"
        >
          Let's Talk
        </AppButton>

        <button
          type="button"
          class="rounded-lg p-2 text-[color:var(--color-muted)] transition-colors hover:bg-white/5 hover:text-white md:hidden"
          aria-label="Open menu"
          :aria-expanded="mobileOpen ? 'true' : 'false'"
          @click="mobileOpen = true"
        >
          <Icon name="lucide:menu" :size="22" aria-hidden="true" />
        </button>
      </div>
    </nav>
  </header>

  <AppDrawer :open="mobileOpen" title="Menu" position="right" @close="closeMenu">
    <p class="mb-4 px-1 text-xs font-semibold uppercase tracking-[0.2em] text-violet-400">
      Navigation
    </p>
    <ul class="space-y-1">
      <li v-for="link in links" :key="link.to">
        <NuxtLink
          :to="link.to"
          class="flex items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition-colors"
          :class="
            isActive(link)
              ? 'bg-violet-500/10 text-white'
              : 'text-[color:var(--color-muted)] hover:bg-white/5 hover:text-white'
          "
          @click="closeMenu"
        >
          {{ link.label }}
          <Icon
            v-if="isActive(link)"
            name="lucide:check"
            :size="16"
            class="text-violet-400"
            aria-hidden="true"
          />
        </NuxtLink>
      </li>
    </ul>

    <AppButton
      class="mt-6 w-full"
      variant="primary"
      icon="lucide:mail"
      to="/contact"
      @click="closeMenu"
    >
      Get in touch
    </AppButton>
  </AppDrawer>
</template>
