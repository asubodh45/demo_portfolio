const API_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api/v1'

export interface Project {
  id: number
  slug: string
  title: string
  tagline?: string
  category: string
  thumbnail: string | null
  year: string
  client?: string
  tags: string[]
  featured: boolean
  overview?: string
  problem?: string
  approach?: string
  solution?: string
  outcome?: string
  images?: string[]
}

export interface Service {
  id: number
  title: string
  description: string
  deliverables: string[]
  icon: string
  sort_order: number
}

export interface ProcessStep {
  id: number
  step_number: number
  title: string
  description: string
  sort_order: number
}

export interface Note {
  id: number
  title: string
  slug: string
  excerpt?: string
  content: string
  cover_image?: string | null
  published_at?: string
}

async function apiFetch<T>(path: string): Promise<T> {
  const res = await fetch(`${API_URL}${path}`, {
    headers: { Accept: 'application/json' },
    next: { revalidate: 60 },
  })
  if (!res.ok) throw new Error(`API ${res.status}: ${path}`)
  const json = await res.json()
  return json.data as T
}

export async function fetchProjects(): Promise<Project[]> {
  try {
    return await apiFetch<Project[]>('/projects')
  } catch {
    return []
  }
}

export async function fetchProject(slug: string): Promise<Project | null> {
  try {
    return await apiFetch<Project>(`/projects/${slug}`)
  } catch {
    return null
  }
}

export async function fetchServices(): Promise<Service[]> {
  try {
    return await apiFetch<Service[]>('/services')
  } catch {
    return []
  }
}

export async function fetchProcessSteps(): Promise<ProcessStep[]> {
  try {
    return await apiFetch<ProcessStep[]>('/process-steps')
  } catch {
    return []
  }
}

export async function fetchNotes(): Promise<Note[]> {
  try {
    return await apiFetch<Note[]>('/notes')
  } catch {
    return []
  }
}

export async function submitContact(data: {
  name: string
  email: string
  message: string
}): Promise<void> {
  const res = await fetch(`${API_URL}/contact`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      Accept: 'application/json',
    },
    body: JSON.stringify(data),
  })
  if (!res.ok) {
    const error = await res.json().catch(() => ({}))
    throw new Error(error.message || 'Failed to send message')
  }
}
