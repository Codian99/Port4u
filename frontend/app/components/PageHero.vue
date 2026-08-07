<script setup lang="ts">
defineOptions({ name: 'PageHero' })

withDefaults(
  defineProps<{
    eyebrow?: string
    title: string
    description?: string
  }>(),
  {
    eyebrow: '',
    description: '',
  }
)
</script>

<template>
  <section class="container-page relative pt-36 pb-16 sm:pt-44 sm:pb-20">
    <div v-reveal class="max-w-3xl">
      <p v-if="eyebrow" class="eyebrow mb-5">{{ eyebrow }}</p>
      <h1 class="text-4xl font-semibold leading-tight tracking-tight sm:text-5xl lg:text-6xl">
        {{ title }}
      </h1>
      <div
        class="mt-6 h-px w-16 bg-gradient-to-r from-blue-400 to-emerald-400"
        aria-hidden="true"
      />
      <p
        v-if="description"
        class="mt-5 max-w-2xl text-base leading-relaxed text-[color:var(--color-muted)] sm:text-lg"
      >
        {{ description }}
      </p>
    </div>
  </section>
</template>
