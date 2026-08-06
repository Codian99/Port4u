<script setup lang="ts">
defineOptions({ name: 'AppModal' })

const props = withDefaults(
  defineProps<{
    open: boolean
    title?: string
    size?: 'sm' | 'md' | 'lg'
    closeOnOverlay?: boolean
  }>(),
  {
    title: undefined,
    size: 'md',
    closeOnOverlay: true,
  }
)

const emit = defineEmits<{ close: [] }>()

const sizeClasses = {
  sm: 'max-w-md',
  md: 'max-w-lg',
  lg: 'max-w-2xl',
}

const body = ref<HTMLElement | null>(null)

watch(
  () => props.open,
  (isOpen) => {
    if (isOpen) {
      document.body.style.overflow = 'hidden'
      nextTick(() => body.value?.focus())
    } else {
      document.body.style.overflow = ''
    }
  }
)

onBeforeUnmount(() => {
  document.body.style.overflow = ''
})

function onOverlayClick() {
  if (props.closeOnOverlay) emit('close')
}

function onKeydown(event: KeyboardEvent) {
  if (event.key === 'Escape') emit('close')
}
</script>

<template>
  <Teleport to="body">
    <Transition name="modal">
      <div
        v-if="open"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        role="dialog"
        aria-modal="true"
        :aria-label="title"
        @keydown="onKeydown"
      >
        <div
          class="absolute inset-0 bg-black/70 backdrop-blur-sm"
          aria-hidden="true"
          @click="onOverlayClick"
        />

        <div
          ref="body"
          tabindex="-1"
          class="card-surface relative z-10 w-full overflow-hidden outline-none"
          :class="sizeClasses[size]"
        >
          <header
            class="flex items-center justify-between border-b border-[color:var(--color-border)] px-6 py-4"
          >
            <h3 class="text-lg font-semibold">{{ title }}</h3>
            <button
              type="button"
              class="rounded-lg p-1.5 text-[color:var(--color-muted)] transition-colors hover:bg-white/5 hover:text-white"
              aria-label="Close dialog"
              @click="emit('close')"
            >
              <Icon name="lucide:x" :size="20" aria-hidden="true" />
            </button>
          </header>
          <div class="px-6 py-5">
            <slot />
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<style scoped>
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.2s ease;
}
.modal-enter-active .card-surface,
.modal-leave-active .card-surface {
  transition:
    transform 0.25s ease,
    opacity 0.25s ease;
}
.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}
.modal-enter-from .card-surface,
.modal-leave-to .card-surface {
  opacity: 0;
  transform: translateY(12px) scale(0.98);
}
</style>
