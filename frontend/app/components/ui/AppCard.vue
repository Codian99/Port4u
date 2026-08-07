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
      hover ? 'card-surface-hover shadow-card' : '',
    ]"
  >
    <slot />
  </article>
</template>
