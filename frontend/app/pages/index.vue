<script setup lang="ts">
import type { AboutProfile, Project, SkillCategory } from '~/types/portfolio'

useSeo({
  title: 'Home',
  description:
    'Portfolio of a Full Stack Web Developer specialising in Nuxt, Vue, Laravel, PHP, WordPress and Docker-based deployments.',
})

const profile = useProfileStore()
const projects = useProjectStore()
const skills = useSkillStore()

const { data: about } = await useAsyncData<AboutProfile>('home-about', () => useApi().getAbout())
const { data: featured } = await useAsyncData<Project[]>('home-featured', () =>
  useApi().getFeaturedProjects()
)
const { data: categories } = await useAsyncData<SkillCategory[]>('home-skills', () =>
  useApi().getSkills()
)

if (about.value) profile.$patch({ about: about.value })
if (featured.value) projects.$patch({ featured: featured.value })
if (categories.value) skills.$patch({ categories: categories.value })

const phrases = ['WordPress Theme & Plugin Expert']

const { text: typedText } = useTypewriter(phrases)

const heroRef = ref<HTMLElement | null>(null)
const scrollHintRef = ref<HTMLElement | null>(null)

const email = computed(() => about.value?.email ?? 'francisian172@gmail.com')

function scrollToProjects() {
  document.getElementById('projects')?.scrollIntoView({ behavior: 'smooth' })
}

onMounted(() => {
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches
  if (reduced) return

  const { gsap } = useGsap()

  const targets = heroRef.value?.querySelectorAll<HTMLElement>('[data-hero]')
  if (targets?.length) {
    gsap.fromTo(
      targets,
      { autoAlpha: 0, y: 30 },
      {
        autoAlpha: 1,
        y: 0,
        duration: 0.8,
        stagger: 0.12,
        ease: 'power3.out',
        delay: 0.1,
      }
    )
  }

  if (scrollHintRef.value) {
    gsap.to(scrollHintRef.value, {
      y: 8,
      duration: 1.2,
      repeat: -1,
      yoyo: true,
      ease: 'sine.inOut',
    })
  }
})
</script>

<template>
  <div>
    <!-- Hero -->
    <section ref="heroRef" class="relative flex min-h-[92vh] items-center">
      <div class="container-page">
        <div class="max-w-3xl space-y-7">
          <div data-hero>
            <span
              class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-500/10 px-3.5 py-1.5 text-xs font-medium text-emerald-300"
            >
              <span class="relative flex h-2 w-2">
                <span
                  class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"
                />
                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400" />
              </span>
              Available for work
            </span>
          </div>

          <p data-hero class="text-sm font-semibold uppercase tracking-[0.25em] text-violet-400">
            Hi, my name is
          </p>

          <h1
            data-hero
            class="text-4xl font-bold leading-tight tracking-tight sm:text-6xl lg:text-7xl"
          >
            {{ about?.name }}
          </h1>

          <div
            data-hero
            class="flex min-h-[2.5rem] items-center text-2xl font-semibold sm:text-3xl"
          >
            <span class="text-gradient">{{ typedText }}</span>
            <span
              class="ml-1 inline-block h-7 w-0.5 animate-pulse bg-violet-400 sm:h-8"
              aria-hidden="true"
            />
          </div>

          <p
            data-hero
            class="max-w-xl text-base leading-relaxed text-[color:var(--color-muted)] sm:text-lg"
          >
            {{ about?.summary }}
          </p>

          <div data-hero class="flex flex-wrap items-center gap-3 pt-2">
            <AppButton to="/projects" size="lg" icon="lucide:folder-git-2" icon-right>
              View Projects
            </AppButton>
            <AppButton to="/contact" size="lg" variant="outline" icon="lucide:mail">
              Get in Touch
            </AppButton>
          </div>
        </div>
      </div>

      <div ref="scrollHintRef" class="absolute bottom-8 left-1/2 hidden -translate-x-1/2 sm:block">
        <button
          type="button"
          class="flex flex-col items-center gap-2 text-[color:var(--color-muted)] transition-colors hover:text-white"
          aria-label="Scroll to projects"
          @click="scrollToProjects"
        >
          <span class="text-xs uppercase tracking-widest">Scroll</span>
          <Icon name="lucide:chevron-down" :size="18" aria-hidden="true" />
        </button>
      </div>
    </section>

    <!-- Featured projects -->
    <section id="projects" class="container-page py-20">
      <div class="mb-12 flex flex-wrap items-end justify-between gap-4">
        <AppSectionTitle eyebrow="Selected Work" title="Featured Projects" />
        <AppButton to="/projects" variant="ghost" icon="lucide:arrow-right" icon-right>
          View all projects
        </AppButton>
      </div>

      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="(project, index) in featured"
          :key="project.slug"
          v-reveal="{ delay: index * 0.1 }"
        >
          <ProjectCard :project="project" />
        </div>
      </div>
    </section>

    <!-- Skills preview -->
    <section class="container-page py-20">
      <AppSectionTitle
        eyebrow="Capabilities"
        title="Technologies I Work With"
        description="A snapshot of the stack I use daily — from design systems to deployment pipelines."
      />

      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="(category, index) in categories"
          :key="category.slug"
          v-reveal="{ delay: index * 0.08 }"
        >
          <AppCard hover>
            <div class="mb-4 flex items-center gap-3">
              <span
                class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-500/10 text-violet-300"
              >
                <Icon :name="category.icon ?? 'lucide:box'" :size="20" aria-hidden="true" />
              </span>
              <h3 class="font-display text-base font-semibold">{{ category.name }}</h3>
            </div>
            <ul class="flex flex-wrap gap-1.5">
              <li v-for="skill in category.skills.slice(0, 5)" :key="skill.id">
                <AppBadge>{{ skill.name }}</AppBadge>
              </li>
            </ul>
          </AppCard>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="container-page pb-24 pt-8">
      <div v-reveal class="card-surface relative overflow-hidden p-10 text-center sm:p-14">
        <div
          class="absolute inset-0 bg-gradient-to-br from-violet-600/10 via-transparent to-cyan-500/10"
          aria-hidden="true"
        />
        <div class="relative">
          <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Have a project in mind?</h2>
          <p class="mx-auto mt-4 max-w-xl text-base text-[color:var(--color-muted)]">
            I'm always open to discussing new opportunities, freelance work or exciting
            collaborations.
          </p>
          <div class="mt-8 flex flex-wrap justify-center gap-3">
            <AppButton :href="`mailto:${email}`" size="lg" icon="lucide:mail">
              {{ email }}
            </AppButton>
            <AppButton to="/contact" size="lg" variant="outline">Contact form</AppButton>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
