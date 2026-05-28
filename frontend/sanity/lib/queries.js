import { groq } from 'next-sanity'

// Fetch all featured projects for homepage
export const featuredProjectsQuery = groq`
  *[_type == "project" && featured == true] | order(order asc) {
    _id,
    title,
    slug,
    client,
    category,
    "featuredImage": featuredImage {
      asset->,
      alt
    },
    description
  }
`

// Fetch single project by slug
export const projectBySlugQuery = groq`
  *[_type == "project" && slug.current == $slug][0] {
    _id,
    title,
    slug,
    client,
    category,
    featuredImage {
      asset->,
      alt
    },
    gallery[] {
      asset->,
      alt
    },
    description,
    content,
    completedAt,
    seo
  }
`

// Fetch all services
export const servicesQuery = groq`
  *[_type == "service"] | order(order asc) {
    _id,
    title,
    slug,
    icon,
    shortDescription,
    features
  }
`

// Fetch site settings
export const siteSettingsQuery = groq`
  *[_type == "siteSettings"][0] {
    siteName,
    tagline,
    heroTitle,
    heroSubtitle,
    aboutText,
    ctaText,
    email,
    socialLinks[] {
      platform,
      url
    },
    defaultSeo
  }
`

// Fetch process steps
export const processStepsQuery = groq`
  *[_type == "processStep"] | order(stepNumber asc) {
    _id,
    stepNumber,
    title,
    description
  }
`