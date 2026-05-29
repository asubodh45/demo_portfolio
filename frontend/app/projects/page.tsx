import { Metadata } from "next"
import { Navbar } from "@/components/navbar"
import { Footer } from "@/components/footer"
import { ProjectsGrid } from "@/components/projects/projects-grid"
import { CTABlock } from "@/components/cta-block"
import { fetchProjects } from "@/lib/api"

export const metadata: Metadata = {
  title: "Projects — Prajesh Shakya",
  description:
    "Explore brand identity projects and case studies by Prajesh Shakya. Strategic design work for ambitious businesses.",
}

export default async function ProjectsPage() {
  const projects = await fetchProjects()

  return (
    <>
      <Navbar />
      <main className="pt-20">
        <ProjectsGrid projects={projects} />
        <CTABlock
          title="Have a project in mind?"
          description="Let&apos;s discuss how we can work together."
        />
      </main>
      <Footer />
    </>
  )
}
