import { defineNuxtPlugin } from '#imports'
import { gsap } from '~/composables/useGsap'

/**
 * Global `v-reveal` directive.
 * Fades + slides elements in as they enter the viewport.
 *
 * Usage: <div v-reveal>…</div> or <div v-reveal="{ delay: 0.2 }">…</div>
 */
export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.vueApp.directive('reveal', {
    mounted(el: HTMLElement, binding) {
      const { delay = 0, y = 24, duration = 0.7 } = binding.value ?? {}

      const reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches

      if (reduced) {
        el.style.opacity = '1'
        return
      }

      gsap.fromTo(
        el,
        { autoAlpha: 0, y },
        {
          autoAlpha: 1,
          y: 0,
          duration,
          delay,
          ease: 'power3.out',
          scrollTrigger: {
            trigger: el,
            start: 'top 88%',
            once: true,
          },
        }
      )
    },
  })
})
