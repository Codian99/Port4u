<script setup lang="ts">
import type { Project } from '~/types/portfolio'

const route = useRoute()
const slug = String(route.params.slug)

const { data: project, error } = await useAsyncData<Project>(`project-${slug}`, () =>
  useApi().getProject(slug)
)

if (error.value || !project.value) {
  throw createError({
    statusCode: 404,
    statusMessage: 'Project not found',
    fatal: true,
  })
}

useSeo({
  title: project.value.title,
  description: project.value.summary,
  image: project.value.thumbnail,
})

const activeImage = ref(project.value.gallery[0] ?? project.value.thumbnail)

const publishedYear = computed(() => {
  const date = project.value?.published_at
  return date ? new Date(date).getFullYear() : undefined
})
</script>

<template>
  <div>
    <article v-if="project">
      <header class="container-page pt-36 pb-10 sm:pt-44 sm:pb-14">
        <div v-reveal class="max-w-3xl space-y-5">
          <div class="flex flex-wrap items-center gap-3">
            <AppBadge v-if="project.featured" variant="accent">
              <Icon name="lucide:star" :size="12" aria-hidden="true" />
              Featured
            </AppBadge>
            <AppBadge v-if="publishedYear">{{ publishedYear }}</AppBadge>
          </div>

          <h1 class="text-4xl font-semibold leading-tight tracking-tight sm:text-5xl">
            {{ project.title }}
          </h1>

          <p class="max-w-2xl text-base leading-relaxed text-[color:var(--color-muted)] sm:text-lg">
            {{ project.summary }}
          </p>

          <div class="flex flex-wrap gap-3 pt-2">
            <AppButton
              v-if="project.github_url"
              :href="project.github_url"
              variant="outline"
              icon="lucide:github"
              external
            >
              View on GitHub
            </AppButton>
            <AppButton
              v-if="project.live_url"
              :href="project.live_url"
              variant="primary"
              icon="lucide:external-link"
              icon-right
              external
            >
              Live Demo
            </AppButton>
          </div>
        </div>
      </header>

      <section class="container-page pb-20">
        <!-- Gallery -->
        <div v-reveal class="grid gap-4 lg:grid-cols-3">
          <div class="card-surface overflow-hidden shadow-card lg:col-span-2">
            <img
              :src="activeImage"
              :alt="`${project.title} screenshot`"
              class="aspect-video w-full object-cover"
              loading="eager"
              decoding="async"
            >
          </div>

          <div
            v-if="project.gallery.length > 1"
            class="grid grid-cols-3 gap-4 lg:grid-cols-1 lg:content-start"
            aria-label="Gallery thumbnails"
          >
            <button
              v-for="image in project.gallery"
              :key="image"
              type="button"
              class="card-surface overflow-hidden transition-all focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-violet-400"
              :class="
                activeImage === image
                  ? 'border-violet-400/60 ring-1 ring-violet-400/40'
                  : 'opacity-60 hover:opacity-100'
              "
              :aria-label="`Show screenshot`"
              @click="activeImage = image"
            >
              <img
                :src="image"
                :alt="''"
                class="aspect-video w-full object-cover"
                loading="lazy"
                decoding="async"
              >
            </button>
          </div>
        </div>

        <div class="mt-14 grid gap-10 lg:grid-cols-5">
          <!-- Description + details -->
          <div class="space-y-10 lg:col-span-3">
            <section v-reveal>
              <h2 class="mb-4 flex items-center gap-3 font-display text-xl font-semibold tracking-tight">
                <span class="h-4 w-1 rounded-full bg-gradient-to-b from-violet-400 to-cyan-400" aria-hidden="true" />
                Overview
              </h2>
              <div class="space-y-4 leading-relaxed text-[color:var(--color-muted)]">
                <p v-for="paragraph in project.description.split(/\n\n+/)" :key="paragraph">
                  {{ paragraph }}
                </p>
              </div>
            </section>

            <section v-if="project.features.length" v-reveal>
              <h2 class="mb-4 flex items-center gap-3 font-display text-xl font-semibold tracking-tight">
                <span class="h-4 w-1 rounded-full bg-gradient-to-b from-violet-400 to-cyan-400" aria-hidden="true" />
                Key Features
              </h2>
              <ul class="space-y-3">
                <li
                  v-for="feature in project.features"
                  :key="feature"
                  class="flex items-start gap-3"
                >
                  <span
                    class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-300"
                  >
                    <Icon name="lucide:check" :size="14" aria-hidden="true" />
                  </span>
                  <span class="text-sm text-[color:var(--color-muted)]">{{ feature }}</span>
                </li>
              </ul>
            </section>

            <section v-if="project.challenges.length" v-reveal>
              <h2 class="mb-4 flex items-center gap-3 font-display text-xl font-semibold tracking-tight">
                <span class="h-4 w-1 rounded-full bg-gradient-to-b from-violet-400 to-cyan-400" aria-hidden="true" />
                Challenges Solved
              </h2>
              <ul class="space-y-3">
                <li
                  v-for="challenge in project.challenges"
                  :key="challenge"
                  class="flex items-start gap-3"
                >
                  <Icon
                    name="lucide:flame"
                    :size="18"
                    class="mt-0.5 flex-shrink-0 text-amber-400"
                    aria-hidden="true"
                  />
                  <span class="text-sm text-[color:var(--color-muted)]">{{ challenge }}</span>
                </li>
              </ul>
            </section>
          </div>

          <!-- Sidebar -->
          <aside class="lg:col-span-2">
            <div v-reveal class="card-surface space-y-6 p-6 shadow-card lg:sticky lg:top-24">
              <div>
                <h2 class="mb-3 font-display text-base font-semibold">Tech Stack</h2>
                <ul class="flex flex-wrap gap-2">
                  <li v-for="tech in project.technologies" :key="tech">
                    <AppBadge variant="outline" size="md">{{ tech }}</AppBadge>
                  </li>
                </ul>
              </div>

              <div class="space-y-2 border-t border-[color:var(--color-border)] pt-5 text-sm">
                <div class="flex items-center justify-between">
                  <span class="text-[color:var(--color-muted)]">Category</span>
                  <span>{{ project.featured ? 'Featured' : 'Standard' }}</span>
                </div>
                <div v-if="publishedYear" class="flex items-center justify-between">
                  <span class="text-[color:var(--color-muted)]">Published</span>
                  <span>{{ publishedYear }}</span>
                </div>
                <div class="flex items-center justify-between">
                  <span class="text-[color:var(--color-muted)]">Status</span>
                  <AppBadge variant="success">Production</AppBadge>
                </div>
              </div>

              <div class="flex flex-col gap-2.5 border-t border-[color:var(--color-border)] pt-5">
                <AppButton
                  v-if="project.github_url"
                  :href="project.github_url"
                  block
                  variant="outline"
                  icon="lucide:github"
                  external
                >
                  Source Code
                </AppButton>
                <AppButton
                  v-if="project.live_url"
                  :href="project.live_url"
                  block
                  variant="primary"
                  icon="lucide:external-link"
                  icon-right
                  external
                >
                  Live Demo
                </AppButton>
              </div>
            </div>
          </aside>
        </div>

        <!-- Back link -->
        <div v-reveal class="mt-16">
          <AppButton to="/projects" variant="ghost" icon="lucide:arrow-left">
            Back to all projects
          </AppButton>
        </div>
      </section>
    </article>
  </div>
</template>
