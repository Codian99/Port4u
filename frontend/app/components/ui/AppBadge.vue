<script setup lang="ts">
defineOptions({ name: 'AppBadge' })

interface Props {
  variant?: 'default' | 'accent' | 'success' | 'outline'
  size?: 'sm' | 'md'
}

withDefaults(defineProps<Props>(), {
  variant: 'default',
  size: 'sm',
})

const variants = {
  default: 'bg-white/[0.06] text-[color:var(--color-muted)] border-white/10',
  accent: 'bg-violet-500/10 text-violet-300 border-violet-400/20',
  success: 'bg-emerald-500/10 text-emerald-300 border-emerald-400/20',
  outline: 'border-[color:var(--color-border)] text-[color:var(--color-text)]',
}

const sizes = {
  sm: 'px-2.5 py-0.5 text-xs',
  md: 'px-3 py-1 text-sm',
}
</script>

<template>
  <span
    class="inline-flex items-center gap-1.5 rounded-full border font-medium"
    :class="[variants[variant], sizes[size]]"
  >
    <slot />
  </span>
</template>
