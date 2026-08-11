<script setup lang="ts">
import { about as staticAbout } from '~/data/about'
import { skillCategories as staticCategories } from '~/data/skills'
import { experiences as staticExperiences } from '~/data/experience'

useSeo({
  title: 'Home',
  description:
    'Portfolio of Francis Ian, a WordPress developer specialising in custom themes, plugins, WooCommerce stores, migrations and performance optimization.',
})

const profile = useProfileStore()
const skills = useSkillStore()

const services = [
  {
    title: 'Custom WordPress Websites',
    description:
      'Lightweight custom themes with zero page-builder bloat, built mobile-first and optimised for Core Web Vitals.',
    icon: 'lucide:layout-template',
  },
  {
    title: 'Custom Plugin Development',
    description:
      'Bespoke plugins that extend WordPress exactly how your business needs, written in clean, maintainable code.',
    icon: 'lucide:puzzle',
  },
  {
    title: 'WooCommerce Development',
    description:
      'Online stores with custom product types, flexible shipping rules and a checkout that actually converts.',
    icon: 'lucide:shopping-cart',
  },
  {
    title: 'Website Migrations',
    description:
      'Zero-downtime moves between hosts with careful planning, a rollback plan and post-migration verification.',
    icon: 'lucide:arrow-left-right',
  },
  {
    title: 'Performance Optimization',
    description:
      'Faster load times and better Core Web Vitals through caching, asset optimisation and clean code.',
    icon: 'lucide:gauge',
  },
  {
    title: 'Hosting & Maintenance',
    description:
      'Reliable management of hosting, backups, security updates and monitoring so you can focus on content.',
    icon: 'lucide:server',
  },
]

const reasons = [
  {
    title: 'Clean, maintainable code',
    description: 'Built on WordPress coding standards with proper escaping and validation throughout.',
    icon: 'lucide:code-2',
  },
  {
    title: 'Performance first',
    description: 'Fast sites that score well on Core Web Vitals — even on budget shared hosting.',
    icon: 'lucide:gauge',
  },
  {
    title: 'Security aware',
    description: 'Hardened setups, up-to-date dependencies and proactive monitoring of every site.',
    icon: 'lucide:shield-check',
  },
  {
    title: 'Troubleshooting expert',
    description: 'Skilled at diagnosing and fixing broken or hacked sites quickly and reliably.',
    icon: 'lucide:search-check',
  },
  {
    title: 'Clear communication',
    description: 'Plain-language updates and honest timelines from kick-off to launch.',
    icon: 'lucide:message-square',
  },
  {
    title: 'Reliable delivery',
    description: 'Years of production experience means fewer surprises and dependable launches.',
    icon: 'lucide:rocket',
  },
]

const about = staticAbout
const categories = staticCategories
const experience = staticExperiences

profile.$patch({ about })
profile.$patch({ experience })
skills.$patch({ categories })

const activeCategory = ref<string | null>(null)

const totalSkills = computed(
  () => categories.reduce((acc, cat) => acc + cat.skills.length, 0)
)

function formatDate(date: string | null): string {
  if (!date) return '—'
  return new Date(date).toLocaleDateString(undefined, {
    year: 'numeric',
    month: 'short',
  })
}

const timelineItems = computed(() =>
  experience.map((item) => ({
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

const form = reactive({
  name: '',
  email: '',
  subject: '',
  message: '',
})

const loading = ref(false)
const success = ref(false)
const serverErrors = ref<Record<string, string>>({})

async function onSubmit() {
  serverErrors.value = {}
  loading.value = true

  try {
    await useApi().submitContact(form)
    success.value = true
    form.name = ''
    form.email = ''
    form.subject = ''
    form.message = ''
  } catch (error: unknown) {
    const err = error as {
      data?: { errors?: Record<string, string[]> }
    }
    const next: Record<string, string> = {}
    for (const [key, messages] of Object.entries(err.data?.errors ?? {})) {
      next[key] = messages[0] ?? ''
    }
    serverErrors.value = next
  } finally {
    loading.value = false
  }
}

const inputClasses =
  'w-full rounded-xl border border-[color:var(--color-border)] bg-[color:var(--color-surface)] px-4 py-3 text-sm text-[color:var(--color-text)] placeholder:text-[color:var(--color-muted)] transition-colors focus:border-blue-400/60 focus:outline-none focus:ring-2 focus:ring-blue-400/30'

const socials = computed(() => [
  {
    name: 'Indeed',
    href: 'https://profile.indeed.com/?hl=en_PH&co=PH&from=gnav-viewjob',
    icon: 'simple-icons:indeed',
  },
  { name: 'Email', href: `mailto:${about.email ?? ''}`, icon: 'lucide:mail' },
])

</script>

<template>
  <div>
    <HeroSection :socials="socials" />

    <!-- About -->
    <section id="about" class="container-page scroll-mt-24 py-20">
      <AppSectionTitle
        eyebrow="About Me"
        title="Who I am"
        description="A WordPress developer who cares about the details — from clean code to fast, secure production sites."
      />

      <div class="grid gap-12 lg:grid-cols-5">
        <div v-reveal class="lg:col-span-2">
          <div class="card-surface relative overflow-hidden p-1.5 shadow-card">
            <div
              class="relative aspect-[4/5] overflow-hidden rounded-xl bg-[color:var(--color-surface-2)]"
            >
              <div
                class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-blue-600/20 to-emerald-500/20"
              >
                <Icon name="lucide:user" :size="96" class="text-white/20" aria-hidden="true" />
              </div>
            </div>
            <div
              class="absolute inset-x-0 bottom-5 mx-auto w-max rounded-full border border-white/10 bg-black/60 px-4 py-1.5 text-xs text-white backdrop-blur"
            >
              {{ about?.location }}
            </div>
          </div>
        </div>

        <div class="lg:col-span-3">
          <div v-reveal class="space-y-5">
            <h2 class="text-2xl font-semibold tracking-tight sm:text-3xl">
              {{ about?.tagline }}
            </h2>
            <p class="leading-relaxed text-[color:var(--color-muted)]">
              {{ about?.summary }}
            </p>
            <p class="leading-relaxed text-[color:var(--color-muted)]">
              On the WordPress side I build custom themes and plugins in PHP, extend stores with
              WooCommerce, and manage hosting, migrations and performance. On the frontend I craft
              fast, responsive interfaces with modern CSS and JavaScript — and when needed, Vue and
              Laravel for bigger builds.
            </p>
          </div>

          <div v-reveal class="mt-10 flex flex-wrap gap-3">
            <AppButton href="/files/resume.pdf" variant="primary" icon="lucide:download" external>
              Download Resume
            </AppButton>
            <AppButton href="#skills" variant="outline" icon="lucide:sparkles">
              Explore Skills
            </AppButton>
          </div>
        </div>
      </div>

      <div class="mt-20">
        <AppSectionTitle
          eyebrow="Education"
          title="Where I learned the craft"
          description="Formal education and continuous learning that shaped my engineering fundamentals."
        />

        <AppTimeline
          v-if="about?.education?.length"
          :items="
            about.education.map((item, index) => ({
              id: index,
              title: item.degree,
              subtitle: item.school,
              period: item.period,
              description: item.description,
            }))
          "
        />
      </div>
    </section>

    <!-- Services -->
    <section id="services" class="container-page scroll-mt-24 py-20">
      <AppSectionTitle
        eyebrow="What I Do"
        title="WordPress Services"
        description="Everything you need to build, grow and maintain a WordPress website — from a single plugin to a full store."
      />

      <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div v-for="(service, index) in services" :key="service.title" v-reveal="{ delay: index * 0.08 }">
          <AppCard hover class="h-full">
            <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500/15 to-emerald-500/10 text-blue-300">
              <Icon :name="service.icon" :size="20" aria-hidden="true" />
            </div>
            <h3 class="font-display text-base font-semibold tracking-tight">{{ service.title }}</h3>
            <p class="mt-2 text-sm leading-relaxed text-[color:var(--color-muted)]">
              {{ service.description }}
            </p>
          </AppCard>
        </div>
      </div>
    </section>

    <!-- Why work with me -->
    <section id="why" class="container-page scroll-mt-24 py-20">
      <AppSectionTitle
        eyebrow="Why Choose Me"
        title="Why Work With Me"
        description="More than a developer — a partner who cares about your website working well long after launch."
      />

      <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div v-for="(reason, index) in reasons" :key="reason.title" v-reveal="{ delay: index * 0.08 }">
          <AppCard hover class="h-full">
            <div class="flex items-start gap-4">
              <span
                class="mt-0.5 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500/15 to-emerald-500/10 text-blue-300"
              >
                <Icon :name="reason.icon" :size="20" aria-hidden="true" />
              </span>
              <div>
                <h3 class="font-display text-base font-semibold tracking-tight">{{ reason.title }}</h3>
                <p class="mt-1.5 text-sm leading-relaxed text-[color:var(--color-muted)]">
                  {{ reason.description }}
                </p>
              </div>
            </div>
          </AppCard>
        </div>
      </div>
    </section>

    <!-- Skills -->
    <section id="skills" class="container-page scroll-mt-24 py-20">
      <AppSectionTitle
        eyebrow="Capabilities"
        title="Technologies I Work With"
        description="From WordPress core and custom plugins to hosting, security and performance — the toolkit behind every project."
      />

      <p
        v-reveal
        class="mb-10 inline-flex items-center gap-2 rounded-full border border-[color:var(--color-border)] bg-[color:var(--color-surface)] px-4 py-1.5 text-sm text-[color:var(--color-muted)]"
      >
        <Icon name="lucide:layout-grid" :size="15" class="text-blue-400" aria-hidden="true" />
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
              class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500/15 to-emerald-500/10 text-blue-300"
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

    <!-- Experience -->
    <section id="experience" class="container-page scroll-mt-24 py-20">
      <AppSectionTitle
        eyebrow="Career"
        title="Professional experience"
        description="Five years of designing, building and maintaining WordPress websites — from custom themes and plugins to WooCommerce stores and hosting management."
      />

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
                <Icon name="lucide:calendar" :size="16" class="text-blue-400" aria-hidden="true" />
                {{ experience?.length ?? 0 }} roles
              </li>
              <li class="flex items-center gap-3">
                <Icon name="lucide:globe" :size="16" class="text-blue-400" aria-hidden="true" />
                Remote-first
              </li>
              <li class="flex items-center gap-3">
                <Icon name="lucide:briefcase" :size="16" class="text-blue-400" aria-hidden="true" />
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

    <!-- Contact -->
    <section id="contact" class="container-page scroll-mt-24 py-20">
      <AppSectionTitle
        eyebrow="Contact"
        title="Let's work together"
        description="Have a WordPress project, a role or just a question? Send a message and I'll get back to you."
      />

      <div class="grid gap-10 lg:grid-cols-5">
        <aside v-reveal class="space-y-6 lg:col-span-2">
          <div class="card-surface space-y-6 p-6 shadow-card">
            <div>
              <h2 class="font-display text-lg font-semibold">Contact details</h2>
              <p class="mt-2 text-sm leading-relaxed text-[color:var(--color-muted)]">
                Prefer direct email? Reach me anytime at the address below.
              </p>
            </div>

            <a
              :href="`mailto:${about?.email}`"
              class="flex items-center gap-3 text-sm transition-colors hover:text-blue-300"
            >
              <span
                class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500/10 text-blue-300"
              >
                <Icon name="lucide:mail" :size="18" aria-hidden="true" />
              </span>
              {{ about?.email }}
            </a>

            <p class="flex items-center gap-3 text-sm text-[color:var(--color-muted)]">
              <span
                class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-500/10 text-blue-300"
              >
                <Icon name="lucide:map-pin" :size="18" aria-hidden="true" />
              </span>
              {{ about?.location }}
            </p>
          </div>

          <div class="card-surface p-6 shadow-card">
            <h2 class="mb-4 font-display text-lg font-semibold tracking-tight">Elsewhere</h2>
            <ul class="space-y-3">
              <li v-for="social in socials" :key="social.name">
                <a
                  :href="social.href"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="flex items-center gap-3 text-sm text-[color:var(--color-muted)] transition-colors hover:text-white"
                >
                  <span
                    class="flex h-10 w-10 items-center justify-center rounded-lg border border-[color:var(--color-border)]"
                  >
                    <Icon :name="social.icon" :size="18" aria-hidden="true" />
                  </span>
                  {{ social.name }}
                </a>
              </li>
            </ul>
          </div>
        </aside>

        <div v-reveal class="lg:col-span-3">
          <div
            v-if="success"
            class="card-surface flex flex-col items-center gap-4 border-emerald-400/30 p-10 text-center"
          >
            <span
              class="flex h-14 w-14 items-center justify-center rounded-full bg-emerald-500/10 text-emerald-300"
            >
              <Icon name="lucide:check-check" :size="28" aria-hidden="true" />
            </span>
            <h2 class="font-display text-xl font-semibold">Message sent!</h2>
            <p class="max-w-md text-sm text-[color:var(--color-muted)]">
              Thanks for reaching out. I'll get back to you as soon as possible.
            </p>
            <AppButton variant="outline" @click="success = false">Send another message</AppButton>
          </div>

          <form
            v-else
            class="card-surface space-y-5 p-6 shadow-card sm:p-8"
            novalidate
            @submit.prevent="onSubmit"
          >
            <div class="grid gap-5 sm:grid-cols-2">
              <div>
                <label for="contact-name" class="mb-2 block text-sm font-medium">Name</label>
                <input
                  id="contact-name"
                  v-model="form.name"
                  type="text"
                  autocomplete="name"
                  required
                  :class="inputClasses"
                  placeholder="Jane Doe"
                >
                <p v-if="serverErrors.name" class="mt-1.5 text-xs text-red-400">
                  {{ serverErrors.name }}
                </p>
              </div>

              <div>
                <label for="contact-email" class="mb-2 block text-sm font-medium">Email</label>
                <input
                  id="contact-email"
                  v-model="form.email"
                  type="email"
                  autocomplete="email"
                  required
                  :class="inputClasses"
                  placeholder="jane@example.com"
                >
                <p v-if="serverErrors.email" class="mt-1.5 text-xs text-red-400">
                  {{ serverErrors.email }}
                </p>
              </div>
            </div>

            <div>
              <label for="contact-subject" class="mb-2 block text-sm font-medium">Subject</label>
              <input
                id="contact-subject"
                v-model="form.subject"
                type="text"
                required
                :class="inputClasses"
                placeholder="Project inquiry"
              >
              <p v-if="serverErrors.subject" class="mt-1.5 text-xs text-red-400">
                {{ serverErrors.subject }}
              </p>
            </div>

            <div>
              <label for="contact-message" class="mb-2 block text-sm font-medium">Message</label>
              <textarea
                id="contact-message"
                v-model="form.message"
                rows="5"
                required
                :class="`${inputClasses} resize-y`"
                placeholder="Tell me about your project…"
              />
              <p v-if="serverErrors.message" class="mt-1.5 text-xs text-red-400">
                {{ serverErrors.message }}
              </p>
            </div>

            <AppButton
              type="submit"
              size="lg"
              block
              :loading="loading"
              icon="lucide:send"
              icon-right
              aria-label="Send message"
            >
              {{ loading ? 'Sending…' : 'Send Message' }}
            </AppButton>
          </form>
        </div>
      </div>
    </section>
  </div>
</template>
