<script setup lang="ts">
defineOptions({ name: 'AppDrawer' })

const props = withDefaults(
  defineProps<{
    open: boolean
    title?: string
    position?: 'left' | 'right'
    closeOnOverlay?: boolean
  }>(),
  {
    title: undefined,
    position: 'right',
    closeOnOverlay: true,
  }
)

const emit = defineEmits<{ close: [] }>()

const positionClasses = {
  left: 'left-0',
  right: 'right-0',
}

const transitionNames = {
  left: 'drawer-left',
  right: 'drawer-right',
}

watch(
  () => props.open,
  (isOpen) => {
    document.body.style.overflow = isOpen ? 'hidden' : ''
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
    <div class="fixed inset-0 z-50 pointer-events-none" @keydown="onKeydown">
      <Transition name="drawer-fade">
        <div
          v-if="open"
          class="absolute inset-0 bg-black/70 backdrop-blur-sm pointer-events-auto"
          aria-hidden="true"
          @click="onOverlayClick"
        />
      </Transition>

      <Transition :name="transitionNames[position]">
        <aside
          v-if="open"
          class="card-surface absolute top-0 flex h-full w-80 max-w-[85vw] flex-col overflow-hidden rounded-none border-l-0 pointer-events-auto"
          :class="positionClasses[position]"
          role="dialog"
          aria-modal="true"
          :aria-label="title ?? 'Navigation menu'"
        >
          <header
            class="flex items-center justify-between border-b border-[color:var(--color-border)] px-5 py-4"
          >
            <p class="font-display text-lg font-semibold">{{ title }}</p>
            <button
              type="button"
              class="rounded-lg p-1.5 text-[color:var(--color-muted)] transition-colors hover:bg-[color:var(--color-hover)] hover:text-[color:var(--color-text)]"
              aria-label="Close menu"
              @click="emit('close')"
            >
              <Icon name="lucide:x" :size="20" aria-hidden="true" />
            </button>
          </header>
          <div class="flex-1 overflow-y-auto px-5 py-4">
            <slot />
          </div>
        </aside>
      </Transition>
    </div>
  </Teleport>
</template>

<style scoped>
.drawer-fade-enter-active,
.drawer-fade-leave-active {
  transition: opacity 0.25s ease;
}
.drawer-fade-enter-from,
.drawer-fade-leave-to {
  opacity: 0;
}
.drawer-right-enter-active,
.drawer-right-leave-active,
.drawer-left-enter-active,
.drawer-left-leave-active {
  transition: transform 0.3s cubic-bezier(0.22, 1, 0.36, 1);
}
.drawer-right-enter-from,
.drawer-right-leave-to {
  transform: translateX(100%);
}
.drawer-left-enter-from,
.drawer-left-leave-to {
  transform: translateX(-100%);
}
</style>
