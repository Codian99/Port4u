<script setup lang="ts">
defineOptions({ name: 'AppSkillBar' })

const props = withDefaults(
  defineProps<{
    name: string
    level: number
    icon?: string | null
    delay?: number
  }>(),
  {
    icon: null,
    delay: 0,
  }
)

const barRef = ref<HTMLElement | null>(null)
const displayLevel = ref(0)

onMounted(() => {
  const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches

  if (reduced) {
    displayLevel.value = props.level
    if (barRef.value) barRef.value.style.width = `${props.level}%`
    return
  }

  const { gsap } = useGsap()
  const counter = { value: 0 }

  gsap.to(counter, {
    value: props.level,
    duration: 1.2,
    delay: props.delay,
    ease: 'power3.out',
    onUpdate() {
      displayLevel.value = Math.round(counter.value)
    },
  })

  gsap.fromTo(
    barRef.value,
    { width: '0%' },
    {
      width: `${props.level}%`,
      duration: 1.2,
      delay: props.delay,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: barRef.value,
        start: 'top 92%',
        once: true,
      },
    }
  )
})
</script>

<template>
  <div class="w-full">
    <div class="mb-2 flex items-center justify-between gap-2">
      <span class="flex items-center gap-2 text-sm font-medium">
        <Icon v-if="icon" :name="icon" :size="16" class="text-blue-400" aria-hidden="true" />
        {{ name }}
      </span>
      <span class="text-xs tabular-nums text-[color:var(--color-muted)]">{{ displayLevel }}%</span>
    </div>
    <div
      class="h-1.5 w-full overflow-hidden rounded-full bg-[color:var(--color-surface-2)] ring-1 ring-inset ring-white/5"
      role="progressbar"
      :aria-valuenow="level"
      aria-valuemin="0"
      aria-valuemax="100"
      :aria-label="`${name} proficiency`"
    >
      <div
        ref="barRef"
        class="h-full w-0 rounded-full bg-gradient-to-r from-blue-500 to-emerald-400"
      />
    </div>
  </div>
</template>
