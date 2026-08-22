<script setup lang="ts">
import { skillCategories } from '~/data/skills'

defineOptions({ name: 'SkillsSection' })

interface CategoryMeta {
  tagline: string
  span: string
  cols: string
}

const categoryMeta: Record<string, CategoryMeta> = {
  wordpress: {
    tagline: 'Primary specialization',
    span: 'sm:col-span-2 lg:col-span-3',
    cols: 'sm:grid-cols-2 lg:grid-cols-3',
  },
  woocommerce: {
    tagline: 'E-commerce specialization',
    span: '',
    cols: '',
  },
  frontend: {
    tagline: 'Supporting expertise',
    span: 'lg:col-span-2',
    cols: 'sm:grid-cols-2',
  },
  hosting: {
    tagline: 'Infrastructure & deployment',
    span: 'lg:col-span-2',
    cols: 'sm:grid-cols-2',
  },
  tools: {
    tagline: 'Development workflow',
    span: '',
    cols: '',
  },
}

function metaFor(slug: string): CategoryMeta {
  return categoryMeta[slug] ?? { tagline: '', span: '', cols: '' }
}

const totalSkills = skillCategories.reduce(
  (acc, category) => acc + category.skills.length,
  0
)
</script>

<template>
  <section id="skills" class="container-page scroll-mt-24 py-20">
    <AppSectionTitle
      eyebrow="Capabilities"
      title="Skills & Expertise"
      description="A WordPress-first toolkit — custom themes and plugins at the core, backed by WooCommerce, modern frontend work, solid hosting know-how and a sharp development workflow."
    />

    <p
      v-reveal
      class="mb-10 inline-flex items-center gap-2 rounded-full border border-[color:var(--color-border)] bg-[color:var(--color-surface)] px-4 py-1.5 text-sm text-[color:var(--color-muted)]"
    >
      <Icon name="lucide:layout-grid" :size="15" class="text-blue-400" aria-hidden="true" />
      {{ totalSkills }} technologies across {{ skillCategories.length }} categories
    </p>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
      <div
        v-for="(category, index) in skillCategories"
        :key="category.slug"
        v-reveal="{ delay: (index % 3) * 0.07 }"
        class="h-full"
        :class="metaFor(category.slug).span"
      >
        <article
          class="card-surface h-full p-6 transition-all duration-300 hover:-translate-y-1 sm:p-7"
          :class="
            category.slug === 'wordpress'
              ? 'border-blue-400/25 bg-gradient-to-br from-blue-500/[0.08] via-transparent to-emerald-500/[0.05] shadow-[0_0_70px_-35px_rgba(59,130,246,0.55)] hover:border-blue-400/50'
              : 'card-surface-hover'
          "
        >
          <header class="mb-6 flex items-center gap-4">
            <span
              class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl border border-[color:var(--color-border)] bg-[color:var(--color-surface-2)] text-blue-400"
              :class="category.slug === 'wordpress' ? 'border-blue-400/30 text-blue-300' : ''"
            >
              <Icon :name="category.icon ?? 'lucide:box'" :size="22" aria-hidden="true" />
            </span>
            <div class="min-w-0">
              <h3
                class="font-display font-semibold tracking-tight"
                :class="category.slug === 'wordpress' ? 'text-xl sm:text-2xl' : 'text-lg'"
              >
                {{ category.name }}
              </h3>
              <p class="mt-0.5 flex items-center gap-1.5 text-xs text-[color:var(--color-muted)]">
                <Icon
                  v-if="category.slug === 'wordpress'"
                  name="lucide:star"
                  :size="12"
                  class="text-blue-400"
                  aria-hidden="true"
                />
                {{ metaFor(category.slug).tagline }}
              </p>
            </div>
          </header>

          <ul class="grid gap-3" :class="metaFor(category.slug).cols">
            <li v-for="skill in category.skills" :key="skill.id">
              <div
                class="group/skill flex items-center gap-3 rounded-xl border border-[color:var(--color-border)] bg-[color:var(--color-surface-2)] px-3.5 py-3 transition duration-200 hover:-translate-y-0.5 hover:border-blue-400/40 hover:bg-[color:var(--color-hover)]"
              >
                <span
                  class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-[color:var(--color-bg)] text-blue-400 ring-1 ring-inset ring-[color:var(--color-border)] transition-transform duration-200 group-hover/skill:scale-110"
                >
                  <Icon :name="skill.icon ?? 'lucide:code'" :size="15" aria-hidden="true" />
                </span>
                <span class="text-sm font-medium leading-snug">{{ skill.name }}</span>
              </div>
            </li>
          </ul>
        </article>
      </div>
    </div>
  </section>
</template>
