<script setup lang="ts">
defineOptions({ name: 'AppCard' })

withDefaults(
  defineProps<{
    hover?: boolean
    padded?: boolean
  }>(),
  {
    hover: true,
    padded: true,
  }
)
</script>

<template>
  <article
    class="card-surface group relative overflow-hidden"
    :class="[
      padded ? 'p-6' : '',
      hover
        ? 'transition-all duration-300 hover:-translate-y-1 hover:border-violet-400/40 hover:shadow-xl hover:shadow-violet-500/10'
        : '',
    ]"
  >
    <slot />
  </article>
</template>
