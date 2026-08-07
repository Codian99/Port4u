<script setup lang="ts">
defineOptions({ name: 'AppButton' })

interface Props {
  to?: string
  href?: string
  variant?: 'primary' | 'outline' | 'ghost'
  size?: 'sm' | 'md' | 'lg'
  icon?: string
  iconRight?: boolean
  external?: boolean
  disabled?: boolean
  loading?: boolean
  block?: boolean
  ariaLabel?: string
}

const props = withDefaults(defineProps<Props>(), {
  variant: 'primary',
  size: 'md',
  to: undefined,
  href: undefined,
  icon: '',
  iconRight: false,
  external: false,
  disabled: false,
  loading: false,
  block: false,
  ariaLabel: undefined,
})

const emit = defineEmits<{ click: [event: MouseEvent] }>()

const sizeClasses = {
  sm: 'px-4 py-2 text-sm',
  md: 'px-5 py-2.5 text-sm',
  lg: 'px-7 py-3.5 text-base',
}

const variantClasses = {
  primary:
    'bg-gradient-to-r from-violet-500 to-indigo-500 text-white shadow-glow-sm hover:shadow-glow hover:brightness-110',
  outline:
    'border border-[color:var(--color-border-strong)] text-[color:var(--color-text)] hover:border-violet-400/60 hover:bg-violet-400/[0.06]',
  ghost: 'text-[color:var(--color-muted)] hover:text-[color:var(--color-text)] hover:bg-white/5',
}

const base =
  'inline-flex items-center justify-center gap-2 rounded-xl font-medium transition-all duration-300 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-violet-400/60 focus-visible:ring-offset-2 focus-visible:ring-offset-[color:var(--color-bg)] disabled:pointer-events-none disabled:opacity-50 active:scale-[0.98]'

function onClick(event: MouseEvent) {
  if (props.disabled || props.loading) return
  emit('click', event)
}
</script>

<template>
  <component
    :is="href ? 'a' : to ? 'NuxtLink' : 'button'"
    :to="to"
    :href="href"
    :target="external ? '_blank' : undefined"
    :rel="external ? 'noopener noreferrer' : undefined"
    :disabled="!to && !href ? disabled : undefined"
    :aria-label="ariaLabel"
    class="cursor-pointer"
    @click="onClick"
  >
    <span
      class="inline-flex items-center justify-center gap-2"
      :class="[base, sizeClasses[size], variantClasses[variant], block ? 'w-full' : '']"
    >
      <AppSpinner v-if="loading" :size="16" class="text-white" />
      <Icon v-else-if="icon && !iconRight" :name="icon" :size="18" aria-hidden="true" />
      <slot />
      <Icon v-if="icon && iconRight" :name="icon" :size="18" aria-hidden="true" />
    </span>
  </component>
</template>
