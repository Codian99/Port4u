import { defineStore } from 'pinia'
import type { AboutProfile, ExperienceItem } from '~/types/portfolio'

export const useProfileStore = defineStore('profile', {
  state: () => ({
    about: null as AboutProfile | null,
    experience: [] as ExperienceItem[],
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchAbout() {
      if (this.about) return
      this.loading = true
      this.error = null
      try {
        const { getAbout } = useApi()
        this.about = await getAbout()
      } catch {
        this.error = 'Failed to load profile.'
      } finally {
        this.loading = false
      }
    },

    async fetchExperience() {
      if (this.experience.length > 0) return
      this.loading = true
      this.error = null
      try {
        const { getExperience } = useApi()
        this.experience = await getExperience()
      } catch {
        this.error = 'Failed to load experience.'
      } finally {
        this.loading = false
      }
    },
  },
})
