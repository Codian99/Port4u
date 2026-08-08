<script setup lang="ts">
defineOptions({ name: 'HeroSection' })

interface SocialLink {
  name: string
  href: string
  icon: string
}

interface Props {
  socials?: SocialLink[]
}

withDefaults(defineProps<Props>(), {
  socials: () => [],
})

const heroRef = ref<HTMLElement | null>(null)
const scrollHintRef = ref<HTMLElement | null>(null)

interface TechCard {
  label: string
  icon: string
  monogram?: string
  color: string
  position: string
  duration: number
  delay: number
  depth: number
}

const techCards: TechCard[] = [
  { label: 'WordPress', icon: 'simple-icons:wordpress', color: '#21759B', position: '-top-5 left-2', duration: 7, delay: -2, depth: 34 },
  { label: 'PHP', icon: 'simple-icons:php', color: '#777BB4', position: 'top-16 -right-2 sm:-right-4', duration: 8.5, delay: -5, depth: 46 },
  { label: 'WooCommerce', icon: 'simple-icons:woocommerce', color: '#7F54B3', position: 'top-24 -left-3 sm:-left-8', duration: 7.5, delay: -1, depth: 28 },
  { label: 'Elementor', icon: 'simple-icons:elementor', color: '#92003B', position: 'top-[13.5rem] right-2 sm:right-0', duration: 9, delay: -4, depth: 40 },
  { label: 'WPBakery', icon: '', monogram: 'WB', color: '#9150C6', position: 'bottom-36 -left-2 sm:-left-6', duration: 8, delay: -3, depth: 32 },
  { label: 'Laravel', icon: 'simple-icons:laravel', color: '#FF2D20', position: 'bottom-28 right-1 sm:right-4', duration: 6.5, delay: -1.5, depth: 50 },
  { label: 'Docker', icon: 'simple-icons:docker', color: '#2496ED', position: 'top-1/2 -left-4 sm:-left-10', duration: 7.5, delay: -4.5, depth: 38 },
  { label: 'MySQL', icon: 'simple-icons:mysql', color: '#4479A1', position: 'top-1/2 -right-3 sm:-right-8', duration: 8.5, delay: -2.5, depth: 26 },
  { label: 'REST API', icon: 'lucide:webhook', color: '#3B82F6', position: 'bottom-44 left-4 sm:left-8', duration: 9.5, delay: -0.5, depth: 44 },
  { label: 'Git', icon: 'simple-icons:git', color: '#F05032', position: 'bottom-6 left-10 sm:left-16', duration: 7, delay: -6, depth: 30 },
  { label: 'cPanel', icon: 'simple-icons:cpanel', color: '#FF6C2C', position: 'bottom-2 right-16 sm:right-24', duration: 8, delay: -3.5, depth: 36 },
  { label: 'Linux', icon: 'simple-icons:linux', color: '#FCC624', position: 'bottom-14 -right-2 sm:-right-6', duration: 9, delay: -1.8, depth: 42 },
]

const stats = [
  { icon: 'lucide:star', label: '3+ Years WordPress Experience' },
  { icon: 'lucide:settings', label: 'Custom Plugins' },
  { icon: 'lucide:shopping-cart', label: 'WooCommerce Solutions' },
  { icon: 'lucide:rocket', label: 'Website Performance Optimization' },
]

const particles = Array.from({ length: 16 }, () => ({
  left: `${(Math.random() * 100).toFixed(2)}%`,
  top: `${(Math.random() * 100).toFixed(2)}%`,
  size: 2 + Math.random() * 3,
}))

const chartBars = [46, 68, 52, 82, 60, 74]

function scrollToServices() {
  document.getElementById('services')?.scrollIntoView({ behavior: 'smooth' })
}

interface HeroContext {
  revert: () => void
  add: (callback: () => unknown) => void
}

let ctx: HeroContext | null = null

onMounted(() => {
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches
  const { gsap } = useGsap()

  ctx = gsap.context(() => {
    if (reduced) return

    const intro = gsap.timeline({ defaults: { ease: 'power3.out' } })

    intro
      .fromTo(
        '[data-hero-badge]',
        { autoAlpha: 0, y: 24 },
        { autoAlpha: 1, y: 0, duration: 0.6 }
      )
      .fromTo(
        '[data-hero-heading]',
        { autoAlpha: 0, y: 44 },
        { autoAlpha: 1, y: 0, duration: 0.85 },
        '-=0.35'
      )
      .fromTo(
        '[data-hero-subtitle]',
        { autoAlpha: 0, y: 32 },
        { autoAlpha: 1, y: 0, duration: 0.7 },
        '-=0.55'
      )
      .fromTo(
        '[data-hero-cta]',
        { autoAlpha: 0, y: 24 },
        { autoAlpha: 1, y: 0, duration: 0.5, stagger: 0.12 },
        '-=0.45'
      )
      .fromTo(
        '[data-hero-stats]',
        { autoAlpha: 0, y: 24 },
        { autoAlpha: 1, y: 0, duration: 0.5, stagger: 0.08 },
        '-=0.4'
      )
      .fromTo(
        '[data-hero-socials]',
        { autoAlpha: 0, y: 16 },
        { autoAlpha: 1, y: 0, duration: 0.5, stagger: 0.08 },
        '-=0.35'
      )
      .fromTo(
        '[data-hero-visual]',
        { autoAlpha: 0, scale: 0.94 },
        { autoAlpha: 1, scale: 1, duration: 1, ease: 'power2.out' },
        '-=0.85'
      )
      .fromTo(
        '[data-hero-visual] .hero-tech-card, [data-hero-visual] .hero-window',
        { autoAlpha: 0, scale: 0.8, y: 20 },
        { autoAlpha: 1, scale: 1, y: 0, duration: 0.5, stagger: 0.045 },
        '-=0.65'
      )
      .fromTo('[data-hero-scroll]', { autoAlpha: 0 }, { autoAlpha: 1, duration: 0.6 }, '-=0.3')

    gsap.fromTo(
      '[data-hero-glow]',
      { xPercent: -50, yPercent: -50, scale: 1, opacity: 0.55 },
      {
        xPercent: -50,
        yPercent: -50,
        scale: 1.18,
        opacity: 1,
        duration: 4,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
      }
    )

    if (scrollHintRef.value) {
      gsap.to(scrollHintRef.value, {
        y: 10,
        duration: 1.2,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
      })
    }

    gsap.utils.toArray<HTMLElement>('.hero-particle').forEach((particle) => {
      gsap.to(particle, {
        y: -48 - Math.random() * 48,
        x: (Math.random() - 0.5) * 36,
        duration: 3.5 + Math.random() * 4,
        repeat: -1,
        yoyo: true,
        ease: 'sine.inOut',
      })
    })

    gsap.to('[data-hero-visual]', {
      yPercent: 12,
      ease: 'none',
      scrollTrigger: {
        trigger: heroRef.value,
        start: 'top top',
        end: 'bottom top',
        scrub: true,
      },
    })
  }, heroRef)

  if (!reduced && window.matchMedia('(pointer: fine)').matches) {
    const quick = gsap.utils.toArray<HTMLElement>('[data-depth]').map((el) => ({
      depth: Number(el.dataset.depth ?? 0),
      x: gsap.quickTo(el, 'x', { duration: 0.6, ease: 'power2.out' }),
      y: gsap.quickTo(el, 'y', { duration: 0.6, ease: 'power2.out' }),
    }))

    function onPointerMove(event: PointerEvent) {
      const nx = event.clientX / window.innerWidth - 0.5
      const ny = event.clientY / window.innerHeight - 0.5
      quick.forEach((t) => {
        t.x(nx * t.depth)
        t.y(ny * t.depth)
      })
    }

    window.addEventListener('pointermove', onPointerMove, { passive: true })
    ctx?.add(() => () => window.removeEventListener('pointermove', onPointerMove))
  }
})

onBeforeUnmount(() => {
  ctx?.revert()
})
</script>

<template>
  <section
    id="home"
    ref="heroRef"
    class="relative flex min-h-screen items-center overflow-hidden"
    aria-label="Introduction"
  >
    <!-- Ambient background -->
    <div class="pointer-events-none absolute inset-0" aria-hidden="true">
      <div
        class="absolute inset-0 bg-grid bg-[length:44px_44px] opacity-40 [mask-image:radial-gradient(ellipse_at_center,black_10%,transparent_70%)]"
      />
      <div
        class="absolute -left-32 top-24 h-[26rem] w-[26rem] rounded-full bg-blue-600/[0.14] blur-[140px] animate-float"
      />
      <div
        class="absolute right-0 top-1/3 h-72 w-72 rounded-full bg-indigo-600/[0.12] blur-[130px] animate-float"
        style="animation-delay: -4s"
      />
      <div
        class="absolute bottom-0 left-1/4 h-64 w-64 rounded-full bg-emerald-500/[0.05] blur-[120px]"
      />
      <span
        v-for="(particle, index) in particles"
        :key="index"
        class="hero-particle absolute rounded-full bg-blue-400/30"
        :style="{
          left: particle.left,
          top: particle.top,
          width: `${particle.size}px`,
          height: `${particle.size}px`,
        }"
      />
    </div>

    <div class="container-page relative z-10 grid items-center gap-16 py-28 lg:grid-cols-12 lg:gap-8">
      <!-- Left column -->
      <div class="lg:col-span-7">
        <div data-hero-badge class="mb-6 flex flex-wrap items-center gap-2.5">
          <span
            class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-4 py-1.5 text-xs font-medium text-[color:var(--color-muted)] backdrop-blur"
          >
            <span aria-hidden="true">👋</span>
            Welcome to My Portfolio
          </span>
          <span
            class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-500/[0.08] px-4 py-1.5 text-xs font-medium text-emerald-300"
          >
            <span class="relative flex h-2 w-2" aria-hidden="true">
              <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75" />
              <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400" />
            </span>
            Available for Freelance Projects
          </span>
        </div>

        <h1
          data-hero-heading
          class="max-w-2xl text-[2.75rem] font-semibold leading-[1.05] tracking-tight sm:text-6xl lg:text-7xl"
        >
          Building High-Performance
          <span
            class="bg-gradient-to-r from-blue-400 via-indigo-400 to-sky-400 bg-clip-text text-transparent"
          >
            WordPress Solutions
          </span>
        </h1>

        <p
          data-hero-subtitle
          class="mt-6 max-w-xl text-base leading-relaxed text-[color:var(--color-muted)] sm:text-lg"
        >
          I specialize in custom WordPress development, custom plugin development, WooCommerce
          customization, website optimization, hosting management, and WordPress troubleshooting. I
          build fast, secure, scalable websites tailored to business needs.
        </p>

        <div data-hero-cta class="mt-9 flex flex-wrap items-center gap-4">
          <AppButton
            href="#services"
            size="lg"
            class="hero-cta"
            icon="lucide:layout-template"
            icon-right
          >
            Explore My Services
          </AppButton>
          <AppButton
            href="#contact"
            size="lg"
            variant="outline"
            class="hero-cta-outline"
            icon="lucide:mail"
          >
            Contact Me
          </AppButton>
        </div>

        <div
          class="mt-12 grid max-w-2xl grid-cols-2 gap-3 sm:grid-cols-4"
          aria-label="Highlights"
        >
          <div
            v-for="stat in stats"
            :key="stat.label"
            data-hero-stats
            class="flex items-center gap-2.5 rounded-xl border border-white/[0.08] bg-white/[0.03] px-3.5 py-2.5 backdrop-blur transition-colors hover:border-blue-400/30"
          >
            <Icon :name="stat.icon" :size="16" class="shrink-0 text-blue-300" aria-hidden="true" />
            <span class="text-xs leading-snug text-[color:var(--color-muted)]">
              {{ stat.label }}
            </span>
          </div>
        </div>

        <div class="mt-9 flex items-center gap-3">
          <a
            v-for="social in socials"
            :key="social.name"
            :href="social.href"
            data-hero-socials
            target="_blank"
            rel="noopener noreferrer"
            :aria-label="social.name"
            class="flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/[0.04] text-[color:var(--color-muted)] backdrop-blur transition-all duration-300 hover:-translate-y-0.5 hover:border-blue-400/50 hover:text-white hover:shadow-glow-sm"
          >
            <Icon :name="social.icon" :size="17" aria-hidden="true" />
          </a>
        </div>
      </div>

      <!-- Right column: developer workspace -->
      <div data-hero-visual class="relative mx-auto w-full max-w-lg lg:col-span-5 lg:max-w-none" aria-hidden="true">
        <div
          data-hero-glow
          class="absolute left-1/2 top-1/2 -z-10 h-[30rem] w-[30rem] rounded-full bg-[radial-gradient(circle_at_center,rgba(59,130,246,0.35),transparent_65%)]"
        />

        <!-- Laptop mockup -->
        <div data-depth="10" class="relative mx-auto w-[86%]">
          <div
            class="overflow-hidden rounded-xl border border-white/10 bg-[#0b1220] shadow-2xl shadow-blue-950/50"
          >
            <div
              class="flex items-center gap-1.5 border-b border-white/[0.08] bg-white/[0.03] px-4 py-2.5"
            >
              <span class="h-2.5 w-2.5 rounded-full bg-[#ff5f57]" />
              <span class="h-2.5 w-2.5 rounded-full bg-[#febc2e]" />
              <span class="h-2.5 w-2.5 rounded-full bg-[#28c840]" />
              <div
                class="ml-3 flex flex-1 items-center gap-1.5 rounded-md bg-black/40 px-3 py-1"
              >
                <Icon name="lucide:lock" :size="10" class="text-emerald-400" aria-hidden="true" />
                <span class="truncate font-mono text-[10px] text-[color:var(--color-muted)]">
                  localhost/wp-admin
                </span>
              </div>
            </div>

            <!-- WordPress dashboard -->
            <div class="flex h-[16rem] sm:h-[18rem]">
              <div class="w-24 shrink-0 border-r border-white/[0.08] bg-white/[0.02] p-3 sm:w-28">
                <div class="mb-4 flex items-center gap-1.5">
                  <span class="h-2 w-2 rounded-full bg-blue-400" aria-hidden="true" />
                  <span class="h-1.5 w-12 rounded bg-white/15" aria-hidden="true" />
                </div>
                <div class="space-y-2.5" aria-hidden="true">
                  <div
                    v-for="item in 6"
                    :key="item"
                    class="h-1.5 rounded"
                    :class="item === 1 ? 'w-full bg-blue-400/50' : 'w-4/5 bg-white/10'"
                  />
                </div>
              </div>

              <div class="flex-1 space-y-3 p-4 sm:p-5">
                <div class="flex items-center justify-between" aria-hidden="true">
                  <span class="h-2.5 w-28 rounded bg-white/15" />
                  <span class="h-5 w-14 rounded-md bg-blue-500/80" />
                </div>

                <div class="grid grid-cols-3 gap-2" aria-hidden="true">
                  <div
                    v-for="card in 3"
                    :key="card"
                    class="space-y-2 rounded-md border border-white/10 bg-white/[0.03] p-2.5"
                  >
                    <span class="block h-2 w-10 rounded bg-white/15" />
                    <span class="block h-2.5 w-12 rounded bg-blue-400/50" />
                  </div>
                </div>

                <div
                  class="flex h-20 items-end gap-1.5 rounded-md border border-white/10 bg-white/[0.03] p-3 sm:h-24"
                  aria-hidden="true"
                >
                  <div
                    v-for="(height, index) in chartBars"
                    :key="index"
                    class="w-4 rounded-t-sm bg-gradient-to-t from-blue-600/50 to-indigo-400/80"
                    :style="{ height: `${height}%` }"
                  />
                </div>

                <div class="flex items-center justify-between" aria-hidden="true">
                  <span class="h-1.5 w-20 rounded bg-white/10" />
                  <span class="flex gap-1">
                    <span v-for="dot in 3" :key="dot" class="h-2 w-2 rounded-full bg-white/10" />
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Laptop base -->
          <div class="relative z-10 -mt-px">
            <div
              class="mx-auto h-3 w-[112%] -translate-x-[5.35%] rounded-b-xl border border-t-0 border-white/10 bg-gradient-to-b from-[#1e293b] to-[#0f172a]"
            />
            <div class="mx-auto h-1.5 w-2/3 rounded-b-lg bg-white/[0.05]" />
          </div>
        </div>

        <!-- Floating tech cards -->
        <div
          v-for="card in techCards"
          :key="card.label"
          data-depth="0"
          :class="[card.position, 'hidden sm:block']"
          class="absolute"
        >
          <div
            class="animate-float"
            :style="{ animationDuration: `${card.duration}s`, animationDelay: `${card.delay}s` }"
          >
            <div
              class="hero-tech-card flex items-center gap-2 rounded-xl border border-white/10 bg-[rgba(30,41,59,0.75)] px-3 py-2 shadow-lg shadow-black/30 backdrop-blur-md transition-colors duration-300 hover:border-blue-400/50"
            >
              <Icon
                v-if="card.icon"
                :name="card.icon"
                :size="15"
                :style="{ color: card.color }"
                aria-hidden="true"
              />
              <span
                v-else
                class="flex h-4 w-4 items-center justify-center rounded font-display text-[8px] font-bold text-white"
                :style="{ backgroundColor: card.color }"
                aria-hidden="true"
              >
                {{ card.monogram }}
              </span>
              <span class="whitespace-nowrap font-display text-[11px] font-medium">
                {{ card.label }}
              </span>
            </div>
          </div>
        </div>

        <!-- VS Code window -->
        <div data-depth="46" class="absolute -left-1 -top-6 hidden sm:block sm:-left-8 sm:-top-10">
          <div class="animate-float" style="animation-duration: 8s; animation-delay: -2.5s">
            <div class="hero-window w-40 overflow-hidden rounded-lg border border-white/10 bg-[rgba(13,21,38,0.9)] shadow-xl shadow-black/40 backdrop-blur-md sm:w-44">
              <div class="flex items-center gap-1 border-b border-white/[0.08] px-2.5 py-1.5">
                <span class="h-1.5 w-1.5 rounded-full bg-[#ff5f57]" />
                <span class="h-1.5 w-1.5 rounded-full bg-[#febc2e]" />
                <span class="h-1.5 w-1.5 rounded-full bg-[#28c840]" />
                <span class="ml-1.5 truncate font-mono text-[8px] text-[color:var(--color-muted)]">
                  functions.php — VS Code
                </span>
              </div>
              <div class="space-y-1.5 p-3 font-mono text-[8px] leading-relaxed">
                <p class="text-blue-300">register_block_type(</p>
                <p class="pl-3 text-emerald-300">'acme/hero',</p>
                <p class="pl-3 text-sky-300">$config</p>
                <p class="text-blue-300">);</p>
                <p class="text-[color:var(--color-muted)]">// theme loaded ✓</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Terminal window -->
        <div data-depth="58" class="absolute -bottom-8 -left-2 hidden sm:block sm:-left-10">
          <div class="animate-float" style="animation-duration: 9s; animation-delay: -5s">
            <div class="hero-window w-44 overflow-hidden rounded-lg border border-white/10 bg-[rgba(6,10,20,0.92)] shadow-xl shadow-black/40 backdrop-blur-md sm:w-52">
              <div class="flex items-center gap-1 border-b border-white/[0.08] px-2.5 py-1.5">
                <span class="h-1.5 w-1.5 rounded-full bg-[#ff5f57]" />
                <span class="h-1.5 w-1.5 rounded-full bg-[#febc2e]" />
                <span class="h-1.5 w-1.5 rounded-full bg-[#28c840]" />
                <span class="ml-1.5 font-mono text-[8px] text-[color:var(--color-muted)]">
                  wp-cli — zsh
                </span>
              </div>
              <div class="space-y-1 p-3 font-mono text-[8px] leading-relaxed">
                <p class="text-[color:var(--color-muted)]">
                  <span class="text-emerald-400">➜</span> ~ wp core status
                </p>
                <p><span class="text-emerald-400">✓</span> WordPress <span class="text-sky-300">6.7</span> healthy</p>
                <p class="text-[color:var(--color-muted)]">
                  <span class="text-emerald-400">➜</span> ~ wp plugin list
                </p>
                <p><span class="text-emerald-400">✓</span> <span class="text-blue-300">woocommerce</span> <span class="text-[color:var(--color-muted)]">9.2</span></p>
                <p class="text-[color:var(--color-muted)]">
                  <span class="text-emerald-400">➜</span> <span class="animate-blink text-white">▋</span>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- cPanel window -->
        <div data-depth="38" class="absolute -right-1 bottom-24 hidden sm:block sm:-right-6">
          <div class="animate-float" style="animation-duration: 7.5s; animation-delay: -1s">
            <div class="hero-window w-32 overflow-hidden rounded-lg border border-white/10 bg-[rgba(13,21,38,0.9)] shadow-xl shadow-black/40 backdrop-blur-md sm:w-36">
              <div class="flex items-center gap-1.5 border-b border-white/[0.08] px-2.5 py-1.5">
                <Icon name="simple-icons:cpanel" :size="10" class="text-[#FF6C2C]" aria-hidden="true" />
                <span class="font-mono text-[8px] text-[color:var(--color-muted)]">cPanel</span>
              </div>
              <div class="grid grid-cols-3 gap-1.5 p-2.5">
                <div
                  v-for="tile in 6"
                  :key="tile"
                  class="flex h-7 flex-col items-center justify-center gap-0.5 rounded bg-white/[0.04]"
                  aria-hidden="true"
                >
                  <span class="h-1 w-3.5 rounded bg-blue-400/50" />
                  <span class="h-1 w-2.5 rounded bg-white/15" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Scroll indicator -->
    <div
      ref="scrollHintRef"
      data-hero-scroll
      class="absolute inset-x-0 bottom-7 hidden justify-center sm:flex"
    >
      <button
        type="button"
        class="group flex flex-col items-center gap-2 text-[color:var(--color-muted)] transition-colors hover:text-white"
        aria-label="Scroll to services"
        @click="scrollToServices"
      >
        <span class="text-[10px] uppercase tracking-[0.25em]">Scroll</span>
        <span class="flex h-9 w-5 items-start justify-center rounded-full border border-white/15 p-1">
          <span
            class="h-1.5 w-1 rounded-full bg-blue-400 transition-transform duration-300 group-hover:translate-y-1"
          />
        </span>
      </button>
    </div>
  </section>
</template>

<style scoped>
.hero-cta :deep(svg),
.hero-cta-outline :deep(svg) {
  transition: transform 0.3s ease;
}
.hero-cta:hover :deep(svg) {
  transform: translateX(4px);
}
.hero-cta-outline:hover :deep(svg) {
  transform: translateX(-4px);
}
</style>
