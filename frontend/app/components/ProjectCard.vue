<script setup lang="ts">
defineOptions({ name: 'ProjectCard' })

defineProps<{
  project: {
    title: string
    summary: string
    description: string
    thumbnail: string
    technologies: string[]
    featured?: boolean
    github_url?: string | null
    live_url?: string | null
    challenges?: string[]
    features?: string[]
  }
}>()

const expanded = ref(false)
</script>

<template>
  <article class="card-surface card-surface-hover group relative flex flex-col overflow-hidden shadow-card">
    <span class="relative block aspect-video overflow-hidden bg-[color:var(--color-surface-2)]">
      <img
        :src="project.thumbnail"
        :alt="`${project.title} thumbnail`"
        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
        loading="lazy"
        decoding="async"
      >
      <span
        class="absolute inset-0 bg-gradient-to-t from-[color:var(--color-surface)] via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"
        aria-hidden="true"
      />
      <AppBadge v-if="project.featured" variant="accent" class="absolute left-3 top-3">
        <Icon name="lucide:star" :size="12" aria-hidden="true" />
        Featured
      </AppBadge>
    </span>

    <div class="flex flex-1 flex-col gap-3 p-5">
      <h3 class="font-display text-lg font-semibold tracking-tight">
        {{ project.title }}
      </h3>

      <p class="text-sm leading-relaxed text-[color:var(--color-muted)]">
        {{ project.summary }}
      </p>

      <ul class="flex flex-wrap gap-1.5" aria-label="Technologies">
        <li v-for="tech in project.technologies.slice(0, 4)" :key="tech">
          <AppBadge>{{ tech }}</AppBadge>
        </li>
        <li v-if="project.technologies.length > 4">
          <AppBadge>+{{ project.technologies.length - 4 }}</AppBadge>
        </li>
      </ul>

      <div
        v-if="project.description || project.challenges?.length || project.features?.length"
        v-show="expanded"
        class="space-y-4 border-t border-[color:var(--color-border)] pt-4"
      >
        <p
          v-if="project.description"
          class="text-sm leading-relaxed text-[color:var(--color-muted)]"
        >
          {{ project.description }}
        </p>

        <div v-if="project.features?.length">
          <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-blue-300">Key features</p>
          <ul class="space-y-1.5">
            <li
              v-for="feature in project.features"
              :key="feature"
              class="flex items-start gap-2 text-sm text-[color:var(--color-muted)]"
            >
              <Icon name="lucide:check" :size="14" class="mt-0.5 shrink-0 text-emerald-300" aria-hidden="true" />
              {{ feature }}
            </li>
          </ul>
        </div>

        <div v-if="project.challenges?.length">
          <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-blue-300">Challenges</p>
          <ul class="space-y-1.5">
            <li
              v-for="challenge in project.challenges"
              :key="challenge"
              class="flex items-start gap-2 text-sm text-[color:var(--color-muted)]"
            >
              <Icon name="lucide:zap" :size="14" class="mt-0.5 shrink-0 text-amber-300" aria-hidden="true" />
              {{ challenge }}
            </li>
          </ul>
        </div>
      </div>

      <div class="mt-auto flex items-center justify-between gap-2 pt-3">
        <div class="flex items-center gap-2">
          <AppButton
            v-if="project.github_url"
            :href="project.github_url"
            variant="outline"
            size="sm"
            icon="lucide:github"
            external
            aria-label="View source code on GitHub"
          >
            GitHub
          </AppButton>
          <AppButton
            v-if="project.live_url"
            :href="project.live_url"
            variant="primary"
            size="sm"
            icon="lucide:external-link"
            icon-right
            external
            aria-label="Open live demo"
          >
            Live Demo
          </AppButton>
        </div>

        <button
          type="button"
          class="inline-flex items-center gap-1 text-sm font-medium text-blue-300 transition-colors hover:text-blue-200"
          :aria-expanded="expanded ? 'true' : 'false'"
          @click="expanded = !expanded"
        >
          {{ expanded ? 'Hide' : 'Details' }}
          <Icon
            :name="expanded ? 'lucide:chevron-up' : 'lucide:chevron-down'"
            :size="15"
            aria-hidden="true"
          />
        </button>
      </div>
    </div>
  </article>
</template>
