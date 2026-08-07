<script setup lang="ts">
import type { AboutProfile } from '~/types/portfolio'

useSeo({
  title: 'About',
  description:
    'Learn about my professional background, experience and the technologies I specialise in.',
})

const { data: about } = await useAsyncData<AboutProfile>('about-profile', () => useApi().getAbout())

const aboutInfo = computed(() => about.value)

const stats = computed(() => [
  { label: 'Years Experience', value: '5+' },
  { label: 'Projects Delivered', value: '40+' },
  { label: 'Technologies', value: '20+' },
  { label: 'Happy Clients', value: '25+' },
])
</script>

<template>
  <div>
    <PageHero
      eyebrow="About Me"
      title="Turning ideas into polished, production-ready web applications."
      description="I'm a Full Stack Web Developer who enjoys the entire journey — from a design mockup in Figma, through a database schema, to a fast, accessible interface deployed to production."
    />

    <section class="container-page grid gap-12 pb-20 lg:grid-cols-5">
      <div v-reveal class="lg:col-span-2">
        <div class="card-surface relative overflow-hidden p-1.5 shadow-card">
          <div
            class="relative aspect-[4/5] overflow-hidden rounded-xl bg-[color:var(--color-surface-2)]"
          >
            <div
              class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-violet-600/20 to-cyan-500/20"
            >
              <Icon name="lucide:user" :size="96" class="text-white/20" aria-hidden="true" />
            </div>
          </div>
          <div
            class="absolute inset-x-0 bottom-5 mx-auto w-max rounded-full border border-white/10 bg-black/60 px-4 py-1.5 text-xs text-white backdrop-blur"
          >
            {{ aboutInfo?.location }}
          </div>
        </div>
      </div>

      <div class="lg:col-span-3">
        <div v-reveal class="space-y-5">
          <p class="eyebrow">About me</p>
          <h2 class="text-2xl font-semibold tracking-tight sm:text-3xl">
            {{ aboutInfo?.tagline }}
          </h2>
          <p class="leading-relaxed text-[color:var(--color-muted)]">
            {{ aboutInfo?.summary }}
          </p>
          <p class="leading-relaxed text-[color:var(--color-muted)]">
            On the frontend I build with Nuxt and Vue, crafting fluid interfaces with Tailwind CSS
            and GSAP. On the backend I design REST APIs with Laravel, model data in MySQL and Redis,
            and ship everything with Docker, Nginx and Linux. I also have deep WordPress experience
            — custom themes, plugins and WooCommerce stores.
          </p>
        </div>

        <ul v-reveal class="mt-8 grid gap-3 sm:grid-cols-2">
          <li
            v-for="highlight in aboutInfo?.highlights"
            :key="highlight"
            class="flex items-start gap-3"
          >
            <span
              class="mt-0.5 flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-violet-500/10 text-violet-300"
            >
              <Icon name="lucide:check" :size="14" aria-hidden="true" />
            </span>
            <span class="text-sm text-[color:var(--color-muted)]">{{ highlight }}</span>
          </li>
        </ul>

        <div v-reveal class="mt-10 grid grid-cols-2 gap-4 sm:grid-cols-4">
          <div
            v-for="stat in stats"
            :key="stat.label"
            class="card-surface p-5 text-center shadow-card"
          >
            <p class="font-display text-2xl font-bold text-gradient">{{ stat.value }}</p>
            <p class="mt-1.5 text-xs text-[color:var(--color-muted)]">{{ stat.label }}</p>
          </div>
        </div>

        <div v-reveal class="mt-10 flex flex-wrap gap-3">
          <AppButton href="/files/resume.pdf" variant="primary" icon="lucide:download">
            Download Resume
          </AppButton>
          <AppButton to="/skills" variant="outline" icon="lucide:sparkles">
            Explore Skills
          </AppButton>
        </div>
      </div>
    </section>

    <section class="container-page pb-24">
      <AppSectionTitle
        eyebrow="Education"
        title="Where I learned the craft"
        description="Formal education and continuous learning that shaped my engineering fundamentals."
      />

      <AppTimeline
        :items="
          (aboutInfo?.education ?? []).map((item, index) => ({
            id: index,
            title: item.degree,
            subtitle: item.school,
            period: item.period,
            description: item.description,
          }))
        "
      />
    </section>
  </div>
</template>
