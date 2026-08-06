<script setup lang="ts">
defineOptions({ name: 'AppSectionTitle' })

interface Props {
  eyebrow?: string
  title: string
  description?: string
  align?: 'left' | 'center'
}

withDefaults(defineProps<Props>(), {
  eyebrow: '',
  description: '',
  align: 'left',
})
</script>

<template>
  <div v-reveal class="mb-12 max-w-2xl" :class="align === 'center' ? 'mx-auto text-center' : ''">
    <p v-if="eyebrow" class="mb-3 text-sm font-semibold uppercase tracking-[0.2em] text-violet-400">
      {{ eyebrow }}
    </p>
    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">
      {{ title }}
    </h2>
    <div
      class="mt-4 h-px w-14 bg-gradient-to-r from-violet-400 to-transparent"
      :class="align === 'center' ? 'mx-auto' : ''"
    />
    <p v-if="description" class="mt-4 text-base leading-relaxed text-[color:var(--color-muted)]">
      {{ description }}
    </p>
  </div>
</template>
