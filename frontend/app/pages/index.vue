<script setup lang="ts">
import type { AboutProfile, Project, SkillCategory } from '~/types/portfolio'

useSeo({
  title: 'Home',
  description:
    'Portfolio of Francis Ian, a full stack web developer specialising in Nuxt, Vue, Laravel, PHP, WordPress and Docker-based deployments.',
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

const stackPreview = computed(() =>
  (categories.value ?? [])
    .flatMap((category) => category.skills.map((skill) => skill.name))
    .slice(0, 8)
)

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
    <section ref="heroRef" class="relative flex min-h-[92vh] items-center overflow-hidden">
      <div class="container-page grid items-center gap-16 py-24 lg:grid-cols-12">
        <div class="space-y-8 lg:col-span-7">
          <div data-hero>
            <span
              class="inline-flex items-center gap-2.5 rounded-full border border-emerald-400/20 bg-emerald-500/[0.08] px-4 py-1.5 text-xs font-medium text-emerald-300"
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

          <div data-hero>
            <p class="eyebrow mb-5">Hi, my name is</p>
            <h1 class="text-5xl font-semibold leading-[1.05] tracking-tight sm:text-6xl lg:text-7xl">
              {{ about?.name }}
            </h1>
          </div>

          <div
            data-hero
            class="flex min-h-[3rem] items-center text-2xl font-semibold sm:text-3xl"
          >
            <span class="text-gradient">{{ typedText }}</span>
            <span
              class="ml-1.5 inline-block h-8 w-0.5 animate-blink bg-violet-400 sm:h-9"
              aria-hidden="true"
            />
          </div>

          <p
            data-hero
            class="max-w-xl text-base leading-relaxed text-[color:var(--color-muted)] sm:text-lg"
          >
            {{ about?.summary }}
          </p>

          <div data-hero class="flex flex-wrap items-center gap-3 pt-1">
            <AppButton to="/projects" size="lg" icon="lucide:folder-git-2" icon-right>
              View Projects
            </AppButton>
            <AppButton to="/contact" size="lg" variant="outline" icon="lucide:mail">
              Get in Touch
            </AppButton>
          </div>
        </div>

        <!-- Terminal card -->
        <div data-hero class="hidden lg:col-span-5 lg:block">
          <div
            class="card-surface overflow-hidden shadow-card"
            role="img"
            aria-label="Terminal showing Francis Ian's profile details"
          >
            <div class="flex items-center gap-2 border-b border-[color:var(--color-border)] px-5 py-3.5">
              <span class="h-3 w-3 rounded-full bg-[#ff5f57]" />
              <span class="h-3 w-3 rounded-full bg-[#febc2e]" />
              <span class="h-3 w-3 rounded-full bg-[#28c840]" />
              <span class="ml-3 font-mono text-xs text-[color:var(--color-muted)]">
                ~/portfolio — zsh
              </span>
            </div>
            <div class="space-y-3 px-6 py-6 font-mono text-sm leading-relaxed">
              <p class="text-[color:var(--color-muted)]">
                <span class="text-emerald-300">➜</span> ~
                <span class="text-violet-300">whoami</span>
              </p>
              <p class="text-[color:var(--color-text)]">{{ about?.name ?? 'Francis Ian' }}</p>

              <p class="text-[color:var(--color-muted)]">
                <span class="text-emerald-300">➜</span> ~
                <span class="text-violet-300">stack</span>
              </p>
              <p class="text-[color:var(--color-text)]">
                {{ stackPreview.join(' · ') }}
              </p>

              <p class="text-[color:var(--color-muted)]">
                <span class="text-emerald-300">➜</span> ~
                <span class="text-violet-300">contact</span>
              </p>
              <p class="break-all text-cyan-300 underline decoration-cyan-400/40 underline-offset-4">
                {{ email }}
              </p>

              <p class="pt-1 text-[color:var(--color-muted)]">
                <span class="text-emerald-300">➜</span> ~
                <span class="animate-blink text-[color:var(--color-text)]">▋</span>
              </p>
            </div>
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

      <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div
          v-for="(category, index) in categories"
          :key="category.slug"
          v-reveal="{ delay: index * 0.08 }"
        >
          <AppCard hover>
            <div class="mb-4 flex items-center gap-3">
              <span
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500/15 to-cyan-500/10 text-violet-300"
              >
                <Icon :name="category.icon ?? 'lucide:box'" :size="20" aria-hidden="true" />
              </span>
              <h3 class="font-display text-base font-semibold tracking-tight">
                {{ category.name }}
              </h3>
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
          class="absolute inset-0 bg-gradient-to-br from-violet-600/[0.12] via-transparent to-cyan-500/[0.08]"
          aria-hidden="true"
        />
        <div
          class="absolute -left-20 -top-20 h-64 w-64 rounded-full bg-violet-600/10 blur-[100px]"
          aria-hidden="true"
        />
        <div class="relative">
          <p class="eyebrow mb-4 justify-center">Let's connect</p>
          <h2 class="text-3xl font-semibold tracking-tight sm:text-4xl">
            Have a project in mind?
          </h2>
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
