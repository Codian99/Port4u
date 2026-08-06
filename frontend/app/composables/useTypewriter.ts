import { computed, onBeforeUnmount, onMounted, ref } from 'vue'

/**
 * Animated typing / erasing loop for hero headlines.
 */
export function useTypewriter(
  phrases: string[],
  options: { typeSpeed?: number; deleteSpeed?: number; holdTime?: number } = {}
) {
  const { typeSpeed = 80, deleteSpeed = 40, holdTime = 1800 } = options

  const text = ref('')
  const activeIndex = ref(0)
  let current = 0
  let deleting = false
  let timer: ReturnType<typeof setTimeout> | null = null

  function tick() {
    const phrase = phrases[activeIndex.value] ?? ''

    if (!deleting) {
      current += 1
      text.value = phrase.slice(0, current)

      if (current === phrase.length) {
        deleting = true
        timer = setTimeout(tick, holdTime)
        return
      }

      timer = setTimeout(tick, typeSpeed)
      return
    }

    current -= 1
    text.value = phrase.slice(0, current)

    if (current === 0) {
      deleting = false
      activeIndex.value = (activeIndex.value + 1) % phrases.length
    }

    timer = setTimeout(tick, deleteSpeed)
  }

  const isTyping = computed(() => !deleting)

  onMounted(() => {
    timer = setTimeout(tick, 300)
  })

  onBeforeUnmount(() => {
    if (timer) clearTimeout(timer)
  })

  return {
    text,
    activeIndex,
    isTyping,
  }
}
