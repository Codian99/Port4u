export interface Project {
  id: number
  title: string
  slug: string
  summary: string
  description: string
  thumbnail: string
  github_url: string | null
  live_url: string | null
  featured: boolean
  technologies: string[]
  gallery: string[]
  challenges: string[]
  features: string[]
  published_at: string | null
}

export interface Skill {
  id: number
  name: string
  /** Backend still returns a proficiency level; the UI no longer renders it. */
  level?: number
  icon: string | null
}

export interface SkillCategory {
  id: number
  name: string
  slug: string
  icon: string | null
  skills: Skill[]
}

export interface ExperienceItem {
  id: number
  role: string
  company: string
  company_url: string | null
  location: string | null
  type: string
  description: string
  technologies: string[]
  start_date: string | null
  end_date: string | null
  current: boolean
}

export interface EducationItem {
  degree: string
  school: string
  period: string
  description: string
}

export interface AboutProfile {
  name: string
  title: string
  tagline: string
  summary: string
  email: string
  location: string
  avatar: string
  resume_url: string
  availability: boolean
  social: {
    github: string
    linkedin: string
    facebook: string
  }
  highlights: string[]
  education: EducationItem[]
}

export interface ContactPayload {
  name: string
  email: string
  subject: string
  message: string
}

export interface ContactResponse {
  data: {
    id: number
    name: string
    email: string
    subject: string
    message: string
    status: string
    created_at: string
  }
}
