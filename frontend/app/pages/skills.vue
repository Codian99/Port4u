<script setup lang="ts">
import type { SkillCategory } from '~/types/portfolio'

useSeo({
  title: 'Skills',
  description:
    'My technical skills across frontend, backend, database, DevOps, CMS and developer tools.',
})

const { data: categories } = await useAsyncData<SkillCategory[]>('skills-page', () =>
  useApi().getSkills()
)

const activeCategory = ref<string | null>(null)

const totalSkills = computed(
  () => categories.value?.reduce((acc, cat) => acc + cat.skills.length, 0) ?? 0
)
</script>

<template>
  <div>
    <PageHero
      eyebrow="Skills"
      title="A toolkit for the full stack"
      description="Six focus areas covering everything from pixel-perfect frontends to containerised deployments. Hover a category to focus on it."
    />

    <section class="container-page pb-24">
      <p v-reveal class="mb-10 inline-flex items-center gap-2 rounded-full border border-[color:var(--color-border)] bg-[color:var(--color-surface)] px-4 py-1.5 text-sm text-[color:var(--color-muted)]">
        <Icon name="lucide:layout-grid" :size="15" class="text-violet-400" aria-hidden="true" />
        {{ totalSkills }} technologies across {{ categories?.length ?? 0 }} categories
      </p>

      <div
        v-for="(category, index) in categories"
        :key="category.slug"
        v-reveal="{ delay: index * 0.06 }"
        class="mb-8"
      >
        <div
          class="card-surface card-surface-hover p-6 sm:p-8"
          :class="activeCategory && activeCategory !== category.slug ? 'opacity-40' : ''"
          @mouseenter="activeCategory = category.slug"
          @mouseleave="activeCategory = null"
          @focusin="activeCategory = category.slug"
          @focusout="activeCategory = null"
        >
          <div class="mb-6 flex items-center gap-4">
            <span
              class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500/15 to-cyan-500/10 text-violet-300"
            >
              <Icon :name="category.icon ?? 'lucide:box'" :size="24" aria-hidden="true" />
            </span>
            <div>
              <h2 class="font-display text-xl font-semibold tracking-tight sm:text-2xl">
                {{ category.name }}
              </h2>
              <p class="text-xs text-[color:var(--color-muted)]">
                {{ category.skills.length }} skills
              </p>
            </div>
          </div>

          <div class="grid gap-x-10 gap-y-6 sm:grid-cols-2">
            <AppSkillBar
              v-for="(skill, skillIndex) in category.skills"
              :key="skill.id"
              :name="skill.name"
              :level="skill.level"
              :icon="skill.icon"
              :delay="(skillIndex % 2) * 0.08"
            />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
