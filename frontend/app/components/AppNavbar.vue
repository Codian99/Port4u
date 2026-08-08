<script setup lang="ts">
defineOptions({ name: 'AppNavbar' })

const colorMode = useColorMode()

const sections = [
  { id: 'home', label: 'Home' },
  { id: 'about', label: 'About' },
  { id: 'skills', label: 'Skills' },
  { id: 'services', label: 'Services' },
  { id: 'contact', label: 'Contact' },
]

const scrolled = ref(false)
const mobileOpen = ref(false)
const activeSection = ref('home')

function isActive(section: { id: string }) {
  return activeSection.value === section.id
}

function onScroll() {
  scrolled.value = window.scrollY > 24
  updateActiveSection()
}

function updateActiveSection() {
  const marker = window.scrollY + window.innerHeight * 0.4
  let current = sections[0]?.id ?? 'home'
  for (const section of sections) {
    const el = document.getElementById(section.id)
    if (el && el.offsetTop <= marker) current = section.id
  }
  activeSection.value = current
}

function closeMenu() {
  mobileOpen.value = false
}

function onNavigate() {
  closeMenu()
}

onMounted(() => {
  onScroll()
  updateActiveSection()
  window.addEventListener('scroll', onScroll, { passive: true })
  window.addEventListener('resize', updateActiveSection)
})

onBeforeUnmount(() => {
  window.removeEventListener('scroll', onScroll)
  window.removeEventListener('resize', updateActiveSection)
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
      <a
        href="#home"
        class="group flex items-center gap-3"
        aria-label="Scroll to top"
        @click="onNavigate"
      >
        <span
          class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-emerald-400 font-display text-sm font-bold text-white shadow-glow-sm transition-transform duration-300 group-hover:scale-105"
        >
          FI
        </span>
        <span class="hidden font-display text-base font-semibold tracking-tight sm:inline">
          Francis Ian
          <span class="text-gradient">.</span>
        </span>
      </a>

      <ul class="hidden items-center gap-1 md:flex" role="menubar">
        <li v-for="section in sections" :key="section.id" role="none">
          <a
            :href="`#${section.id}`"
            role="menuitem"
            class="relative rounded-lg px-3.5 py-2 text-sm font-medium transition-colors"
            :class="
              isActive(section) ? 'text-white' : 'text-[color:var(--color-muted)] hover:text-white'
            "
            :aria-current="isActive(section) ? 'true' : undefined"
            @click="onNavigate"
          >
            {{ section.label }}
            <span
              class="absolute inset-x-3.5 -bottom-0.5 h-px bg-gradient-to-r from-blue-400 to-emerald-400 transition-transform duration-300"
              :class="isActive(section) ? 'scale-x-100' : 'scale-x-0'"
              aria-hidden="true"
            />
          </a>
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
          href="#contact"
          size="sm"
          class="hidden md:inline-flex"
          icon="lucide:rocket"
          icon-right
          @click="onNavigate"
        >
          Hire Me
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
    <p class="mb-4 px-1 text-xs font-semibold uppercase tracking-[0.2em] text-blue-400">
      Navigation
    </p>
    <ul class="space-y-1">
      <li v-for="section in sections" :key="section.id">
        <a
          :href="`#${section.id}`"
          class="flex items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition-colors"
          :class="
            isActive(section)
              ? 'bg-blue-500/10 text-white'
              : 'text-[color:var(--color-muted)] hover:bg-white/5 hover:text-white'
          "
          @click="onNavigate"
        >
          {{ section.label }}
          <Icon
            v-if="isActive(section)"
            name="lucide:check"
            :size="16"
            class="text-blue-400"
            aria-hidden="true"
          />
        </a>
      </li>
    </ul>

    <AppButton
      class="mt-6 w-full"
      variant="primary"
      icon="lucide:mail"
      href="#contact"
      @click="onNavigate"
    >
      Get in touch
    </AppButton>
  </AppDrawer>
</template>
