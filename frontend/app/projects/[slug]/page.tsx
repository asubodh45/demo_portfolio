import { Metadata } from "next"
import { notFound } from "next/navigation"
import { Navbar } from "@/components/navbar"
import { Footer } from "@/components/footer"
import { ProjectHero } from "@/components/projects/project-hero"
import { ProjectContent } from "@/components/projects/project-content"
import { ProjectGallery } from "@/components/projects/project-gallery"
import { ProjectNavigation } from "@/components/projects/project-navigation"
import { CTABlock } from "@/components/cta-block"
import { fetchProject, fetchProjects } from "@/lib/api"

interface ProjectPageProps {
  params: Promise<{ slug: string }>
}

export async function generateMetadata({
  params,
}: ProjectPageProps): Promise<Metadata> {
  const { slug } = await params
  const project = await fetchProject(slug)

  if (!project) {
    return { title: "Project Not Found" }
  }

  return {
    title: `${project.title} — Prajesh Shakya`,
    description: project.overview,
  }
}

export default async function ProjectPage({ params }: ProjectPageProps) {
  const { slug } = await params
  const [project, projects] = await Promise.all([
    fetchProject(slug),
    fetchProjects(),
  ])

  if (!project) {
    notFound()
  }

  const currentIndex = projects.findIndex((p) => p.slug === slug)
  const prevProject = currentIndex > 0 ? projects[currentIndex - 1] : null
  const nextProject =
    currentIndex < projects.length - 1 ? projects[currentIndex + 1] : null

  return (
    <>
      <Navbar />
      <main className="pt-20">
        <ProjectHero project={project} />
        <ProjectContent project={project} />
        <ProjectGallery project={project} />
        <ProjectNavigation prev={prevProject} next={nextProject} />
        <CTABlock
          title="Inspired by this project?"
          description="Let&apos;s discuss how we can create something similar for your brand."
        />
      </main>
      <Footer />
    </>
  )
}
