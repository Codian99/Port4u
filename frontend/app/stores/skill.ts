import { defineStore } from 'pinia'
import type { SkillCategory } from '~/types/portfolio'

export const useSkillStore = defineStore('skill', {
  state: () => ({
    categories: [] as SkillCategory[],
    loading: false,
    error: null as string | null,
  }),

  actions: {
    async fetchSkills() {
      if (this.categories.length > 0) return
      this.loading = true
      this.error = null
      try {
        const { getSkills } = useApi()
        this.categories = await getSkills()
      } catch {
        this.error = 'Failed to load skills.'
      } finally {
        this.loading = false
      }
    },
  },
})
