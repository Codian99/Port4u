<script setup lang="ts">
import type { AboutProfile } from '~/types/portfolio'

useSeo({
  title: 'Contact',
  description: 'Get in touch — I reply to every message, usually within 48 hours.',
})

const { data: about } = await useAsyncData<AboutProfile>('contact-about', () => useApi().getAbout())

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
  'w-full rounded-lg border border-[color:var(--color-border)] bg-white/[0.03] px-4 py-3 text-sm text-[color:var(--color-text)] placeholder:text-[color:var(--color-muted)] transition-colors focus:border-violet-400/60 focus:outline-none focus:ring-2 focus:ring-violet-400/30'

const socials = computed(() => [
  { name: 'GitHub', href: about.value?.social.github ?? '#', icon: 'lucide:github' },
  { name: 'LinkedIn', href: about.value?.social.linkedin ?? '#', icon: 'lucide:linkedin' },
  { name: 'Facebook', href: about.value?.social.facebook ?? '#', icon: 'lucide:facebook' },
  { name: 'Email', href: `mailto:${about.value?.email ?? ''}`, icon: 'lucide:mail' },
])
</script>

<template>
  <div>
    <PageHero
      eyebrow="Contact"
      title="Let's work together"
      description="Have a project, a role or just a question? Send a message — the form is wired to the Laravel backend and I'll get back to you."
    />

    <section class="container-page grid gap-10 pb-24 lg:grid-cols-5">
      <aside v-reveal class="space-y-6 lg:col-span-2">
        <div class="card-surface space-y-6 p-6">
          <div>
            <h2 class="font-display text-lg font-semibold">Contact details</h2>
            <p class="mt-2 text-sm leading-relaxed text-[color:var(--color-muted)]">
              Prefer direct email? Reach me anytime at the address below.
            </p>
          </div>

          <a
            :href="`mailto:${about?.email}`"
            class="flex items-center gap-3 text-sm transition-colors hover:text-violet-300"
          >
            <span
              class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-500/10 text-violet-300"
            >
              <Icon name="lucide:mail" :size="18" aria-hidden="true" />
            </span>
            {{ about?.email }}
          </a>

          <p class="flex items-center gap-3 text-sm text-[color:var(--color-muted)]">
            <span
              class="flex h-10 w-10 items-center justify-center rounded-lg bg-violet-500/10 text-violet-300"
            >
              <Icon name="lucide:map-pin" :size="18" aria-hidden="true" />
            </span>
            {{ about?.location }}
          </p>
        </div>

        <div class="card-surface p-6">
          <h2 class="mb-4 font-display text-lg font-semibold">Elsewhere</h2>
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
          class="card-surface space-y-5 p-6 sm:p-8"
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
    </section>
  </div>
</template>
