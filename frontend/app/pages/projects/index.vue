<script setup lang="ts">
import type { Project } from '~/types/portfolio'

useSeo({
  title: 'Projects',
  description:
    'A selection of projects across WordPress development, Laravel APIs, Nuxt dashboards and Docker deployments.',
})

const { data: projects } = await useAsyncData<Project[]>('all-projects', () =>
  useApi().getProjects()
)

const filter = ref<'all' | 'featured'>('all')

const visibleProjects = computed(() => {
  if (!projects.value) return []
  return filter.value === 'featured' ? projects.value.filter((p) => p.featured) : projects.value
})
</script>

<template>
  <div>
    <PageHero
      eyebrow="Portfolio"
      title="Projects & case studies"
      description="A curated selection of work spanning WordPress, Laravel, Vue and infrastructure. Every project ships with source code and a live demo where available."
    />

    <section class="container-page pb-24">
      <div v-reveal class="mb-10 flex flex-wrap items-center gap-3">
        <button
          type="button"
          class="rounded-lg px-4 py-2 text-sm font-medium transition-all"
          :class="
            filter === 'all'
              ? 'bg-gradient-to-r from-violet-500 to-indigo-500 text-white shadow-lg shadow-violet-500/25'
              : 'border border-[color:var(--color-border)] text-[color:var(--color-muted)] hover:text-white'
          "
          :aria-pressed="filter === 'all'"
          @click="filter = 'all'"
        >
          All Projects
        </button>
        <button
          type="button"
          class="rounded-lg px-4 py-2 text-sm font-medium transition-all"
          :class="
            filter === 'featured'
              ? 'bg-gradient-to-r from-violet-500 to-indigo-500 text-white shadow-lg shadow-violet-500/25'
              : 'border border-[color:var(--color-border)] text-[color:var(--color-muted)] hover:text-white'
          "
          :aria-pressed="filter === 'featured'"
          @click="filter = 'featured'"
        >
          <Icon name="lucide:star" :size="15" class="mr-1.5 inline" aria-hidden="true" />
          Featured
        </button>
      </div>

      <div v-if="visibleProjects.length" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="(project, index) in visibleProjects"
          :key="project.slug"
          v-reveal="{ delay: (index % 3) * 0.08 }"
        >
          <ProjectCard :project="project" />
        </div>
      </div>

      <div v-else class="py-20 text-center">
        <AppSpinner :size="36" />
        <p class="mt-4 text-sm text-[color:var(--color-muted)]">Loading projects…</p>
      </div>
    </section>
  </div>
</template>
