import { defineStore } from 'pinia'
import type { Project } from '~/types/portfolio'

export const useProjectStore = defineStore('project', {
  state: () => ({
    projects: [] as Project[],
    featured: [] as Project[],
    current: null as Project | null,
    loading: false,
    error: null as string | null,
  }),

  getters: {
    bySlug: (state) => (slug: string) =>
      state.projects.find((p) => p.slug === slug) ?? state.current,
  },

  actions: {
    async fetchProjects() {
      if (this.projects.length > 0) return
      this.loading = true
      this.error = null
      try {
        const { getProjects } = useApi()
        this.projects = await getProjects()
      } catch {
        this.error = 'Failed to load projects.'
      } finally {
        this.loading = false
      }
    },

    async fetchFeatured() {
      if (this.featured.length > 0) return
      try {
        const { getFeaturedProjects } = useApi()
        this.featured = await getFeaturedProjects()
      } catch {
        this.error = 'Failed to load featured projects.'
      }
    },

    async fetchProject(slug: string) {
      this.loading = true
      this.error = null
      try {
        const { getProject } = useApi()
        this.current = await getProject(slug)
      } catch {
        this.error = 'Failed to load project.'
      } finally {
        this.loading = false
      }
    },

    clearCurrent() {
      this.current = null
    },
  },
})
