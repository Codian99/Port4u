<script setup lang="ts">
defineOptions({ name: 'ProjectCard' })

defineProps<{
  project: {
    title: string
    slug: string
    summary: string
    thumbnail: string
    technologies: string[]
    featured?: boolean
    github_url?: string | null
    live_url?: string | null
  }
}>()
</script>

<template>
  <article class="card-surface group relative flex flex-col overflow-hidden">
    <NuxtLink
      :to="`/projects/${project.slug}`"
      class="focus-visible:outline-none"
      aria-label="View project"
    >
      <span class="relative block aspect-video overflow-hidden bg-[color:var(--color-surface-2)]">
        <img
          :src="project.thumbnail"
          :alt="`${project.title} thumbnail`"
          class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
          loading="lazy"
          decoding="async"
        >
        <span
          class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"
          aria-hidden="true"
        />
        <AppBadge v-if="project.featured" variant="accent" class="absolute left-3 top-3">
          <Icon name="lucide:star" :size="12" aria-hidden="true" />
          Featured
        </AppBadge>
      </span>
    </NuxtLink>

    <div class="flex flex-1 flex-col gap-3 p-5">
      <h3 class="font-display text-lg font-semibold">
        <NuxtLink
          :to="`/projects/${project.slug}`"
          class="link-underline transition-colors hover:text-violet-300"
        >
          {{ project.title }}
        </NuxtLink>
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

      <div class="mt-auto flex items-center gap-2 pt-2">
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
    </div>
  </article>
</template>
