<script setup lang="ts">
defineOptions({ name: 'ContactForm' })

const api = useApi()

const form = reactive({
  name: '',
  email: '',
  subject: '',
  message: '',
})

const sending = ref(false)
const sent = ref(false)
const error = ref('')

async function submit() {
  error.value = ''
  sending.value = true
  try {
    await api.submitContact(form)
    sent.value = true
  } catch {
    error.value = 'Something went wrong. Please try again.'
  } finally {
    sending.value = false
  }
}
</script>

<template>
  <div v-reveal class="card-surface space-y-6 p-6 shadow-card sm:p-8">
    <div>
      <h2 class="font-display text-lg font-semibold">Send a message</h2>
      <p class="mt-2 text-sm leading-relaxed text-[color:var(--color-muted)]">
        Fill in the form below and I'll get back to you as soon as possible.
      </p>
    </div>

    <div v-if="sent" class="rounded-lg border border-emerald-400/30 bg-emerald-400/10 p-4 text-sm text-emerald-300">
      Thanks! Your message has been sent. I'll get back to you shortly.
    </div>

    <form v-else class="space-y-4" @submit.prevent="submit">
      <div class="grid gap-4 sm:grid-cols-2">
        <div class="space-y-1.5">
          <label for="contact-name" class="text-sm font-medium text-[color:var(--color-text)]">Name</label>
          <input
            id="contact-name"
            v-model="form.name"
            type="text"
            required
            placeholder="Your name"
            class="w-full rounded-lg border border-[color:var(--color-border)] bg-[color:var(--color-bg)] px-4 py-2.5 text-sm text-[color:var(--color-text)] placeholder:text-[color:var(--color-muted)] focus:border-blue-400/60 focus:outline-none focus:ring-2 focus:ring-blue-400/30"
          >
        </div>
        <div class="space-y-1.5">
          <label for="contact-email" class="text-sm font-medium text-[color:var(--color-text)]">Email</label>
          <input
            id="contact-email"
            v-model="form.email"
            type="email"
            required
            placeholder="you@example.com"
            class="w-full rounded-lg border border-[color:var(--color-border)] bg-[color:var(--color-bg)] px-4 py-2.5 text-sm text-[color:var(--color-text)] placeholder:text-[color:var(--color-muted)] focus:border-blue-400/60 focus:outline-none focus:ring-2 focus:ring-blue-400/30"
          >
        </div>
      </div>

      <div class="space-y-1.5">
        <label for="contact-subject" class="text-sm font-medium text-[color:var(--color-text)]">Subject</label>
        <input
          id="contact-subject"
          v-model="form.subject"
          type="text"
          required
          placeholder="What's this about?"
          class="w-full rounded-lg border border-[color:var(--color-border)] bg-[color:var(--color-bg)] px-4 py-2.5 text-sm text-[color:var(--color-text)] placeholder:text-[color:var(--color-muted)] focus:border-blue-400/60 focus:outline-none focus:ring-2 focus:ring-blue-400/30"
        >
      </div>

      <div class="space-y-1.5">
        <label for="contact-message" class="text-sm font-medium text-[color:var(--color-text)]">Message</label>
        <textarea
          id="contact-message"
          v-model="form.message"
          required
          rows="5"
          placeholder="Tell me about your project..."
          class="w-full resize-none rounded-lg border border-[color:var(--color-border)] bg-[color:var(--color-bg)] px-4 py-2.5 text-sm text-[color:var(--color-text)] placeholder:text-[color:var(--color-muted)] focus:border-blue-400/60 focus:outline-none focus:ring-2 focus:ring-blue-400/30"
        />
      </div>

      <div v-if="error" class="rounded-lg border border-red-400/30 bg-red-400/10 p-3 text-sm text-red-300">
        {{ error }}
      </div>

      <AppButton type="submit" :loading="sending" block>
        Send Message
      </AppButton>
    </form>
  </div>
</template>
