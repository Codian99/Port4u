<script setup lang="ts">
import type { ExperienceItem } from '~/types/portfolio'

useSeo({
  title: 'Experience',
  description:
    'My professional journey — the teams, products and technologies I have worked with over the years.',
})

const { data: experience } = await useAsyncData<ExperienceItem[]>('experience-page', () =>
  useApi().getExperience()
)

const timelineItems = computed(() =>
  (experience.value ?? []).map((item) => ({
    id: item.id,
    title: item.role,
    subtitle: item.company,
    url: item.company_url,
    period: item.current
      ? `${formatDate(item.start_date)} — Present`
      : `${formatDate(item.start_date)} — ${formatDate(item.end_date)}`,
    location: item.location,
    description: item.description,
    tags: item.technologies,
    current: item.current,
  }))
)

function formatDate(date: string | null): string {
  if (!date) return '—'
  return new Date(date).toLocaleDateString(undefined, {
    year: 'numeric',
    month: 'short',
  })
}
</script>

<template>
  <div>
    <PageHero
      eyebrow="Career"
      title="Professional experience"
      description="Five years of designing, building and maintaining WordPress websites — from custom themes and plugins to WooCommerce stores and hosting management."
    />

    <section class="container-page pb-24">
      <div class="grid gap-12 lg:grid-cols-3">
        <div class="lg:col-span-2">
          <AppTimeline v-if="timelineItems.length" :items="timelineItems" />

          <div v-else class="py-20 text-center">
            <AppSpinner :size="36" />
            <p class="mt-4 text-sm text-[color:var(--color-muted)]">Loading experience…</p>
          </div>
        </div>

        <aside class="space-y-6">
          <div v-reveal class="card-surface p-6 shadow-card">
            <h2 class="mb-4 flex items-center gap-2.5 font-display text-base font-semibold tracking-tight">
              <Icon name="lucide:gauge" :size="17" class="text-blue-400" aria-hidden="true" />
              At a glance
            </h2>
            <ul class="space-y-3 text-sm text-[color:var(--color-muted)]">
              <li class="flex items-center gap-3">
                <Icon
                  name="lucide:calendar"
                  :size="16"
                  class="text-blue-400"
                  aria-hidden="true"
                />
                {{ experience?.length ?? 0 }} roles
              </li>
              <li class="flex items-center gap-3">
                <Icon name="lucide:globe" :size="16" class="text-blue-400" aria-hidden="true" />
                Remote-first
              </li>
              <li class="flex items-center gap-3">
                <Icon
                  name="lucide:briefcase"
                  :size="16"
                  class="text-blue-400"
                  aria-hidden="true"
                />
                Full-time & freelance
              </li>
            </ul>
          </div>

          <div v-reveal class="card-surface p-6 shadow-card">
            <h2 class="mb-4 flex items-center gap-2.5 font-display text-base font-semibold tracking-tight">
              <Icon name="lucide:target" :size="17" class="text-blue-400" aria-hidden="true" />
              Focus areas
            </h2>
            <ul class="flex flex-wrap gap-2">
              <li
                v-for="tag in [
                  'WordPress',
                  'Custom Themes',
                  'Plugins',
                  'WooCommerce',
                  'Performance',
                ]"
                :key="tag"
              >
                <AppBadge>{{ tag }}</AppBadge>
              </li>
            </ul>
          </div>
        </aside>
      </div>
    </section>
  </div>
</template>
