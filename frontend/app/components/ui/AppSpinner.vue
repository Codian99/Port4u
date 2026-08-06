<script setup lang="ts">
defineOptions({ name: 'AppSpinner' })

withDefaults(
  defineProps<{
    size?: number
    stroke?: number
    label?: string
  }>(),
  {
    size: 28,
    stroke: 3,
    label: 'Loading',
  }
)
</script>

<template>
  <svg
    class="inline-block animate-spin text-violet-400"
    :width="size"
    :height="size"
    viewBox="0 0 24 24"
    fill="none"
    role="status"
    :aria-label="label"
  >
    <circle
      cx="12"
      cy="12"
      r="10"
      :stroke-width="stroke"
      stroke="currentColor"
      class="opacity-20"
    />
    <path
      d="M22 12a10 10 0 0 1-10 10"
      :stroke-width="stroke"
      stroke-linecap="round"
      stroke="currentColor"
    />
  </svg>
</template>
