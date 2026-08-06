import gsap from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { ScrollToPlugin } from 'gsap/ScrollToPlugin'
import { TextPlugin } from 'gsap/TextPlugin'

let registered = false

/**
 * Returns a singleton GSAP instance with common plugins registered.
 */
export function useGsap() {
  if (!registered) {
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin, TextPlugin)
    registered = true
  }

  return {
    gsap,
    ScrollTrigger,
  }
}

export { gsap, ScrollTrigger }
