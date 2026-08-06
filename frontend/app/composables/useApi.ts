import type {
  AboutProfile,
  ContactPayload,
  ContactResponse,
  ExperienceItem,
  Project,
  SkillCategory,
} from '~/types/portfolio'

interface ApiResponse<T> {
  data: T
}

/**
 * Typed wrapper around the Laravel REST API.
 * Handles the base URL, serialization, timeouts and error extraction.
 */
export function useApi() {
  const config = useRuntimeConfig()
  const base = config.public.apiBase

  async function get<T>(path: string, options: Record<string, unknown> = {}): Promise<T> {
    const response = await $fetch<T>(`${base}${path}`, {
      timeout: 10000,
      ...options,
    } as Parameters<typeof $fetch>[1])
    return response
  }

  async function post<T>(path: string, body: object): Promise<T> {
    const response = await $fetch<T>(`${base}${path}`, {
      method: 'POST',
      timeout: 10000,
      body: body as Record<string, unknown>,
    } as Parameters<typeof $fetch>[1])
    return response
  }

  return {
    get,
    post,

    getProjects(): Promise<Project[]> {
      return get<ApiResponse<Project[]>>('/projects').then((r) => r.data)
    },

    getFeaturedProjects(): Promise<Project[]> {
      return get<ApiResponse<Project[]>>('/projects/featured').then((r) => r.data)
    },

    getProject(slug: string): Promise<Project> {
      return get<ApiResponse<Project>>(`/projects/${slug}`).then((r) => r.data)
    },

    getSkills(): Promise<SkillCategory[]> {
      return get<ApiResponse<SkillCategory[]>>('/skills').then((r) => r.data)
    },

    getExperience(): Promise<ExperienceItem[]> {
      return get<ApiResponse<ExperienceItem[]>>('/experience').then((r) => r.data)
    },

    getAbout(): Promise<AboutProfile> {
      return get<AboutProfile>('/about')
    },

    submitContact(payload: ContactPayload): Promise<ContactResponse> {
      return post<ContactResponse>('/contact', payload)
    },
  }
}
