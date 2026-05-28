"use client"

import Link from "next/link"
import { Section, SectionHeader } from "@/components/section"
import { ProjectCard, ProjectCardLarge } from "@/components/project-card"
import { projects } from "@/lib/projects"
import { ArrowRight } from "lucide-react"

export function SelectedWorkSection() {
  const featuredProjects = projects.slice(0, 4)
  const [featured, ...rest] = featuredProjects

  return (
    <Section>
      <SectionHeader
        label="Selected Work"
        title="Projects that define brands"
      />

      {/* Featured Project - Large */}
      <div className="mb-12">
        <ProjectCardLarge project={featured} />
      </div>

      {/* Other Projects - Grid */}
      <div className="grid md:grid-cols-3 gap-8 md:gap-6">
        {rest.map((project, index) => (
          <ProjectCard key={project.slug} project={project} index={index} />
        ))}
      </div>

      {/* View All Link */}
      <div className="mt-16 text-center">
        <Link
          href="/projects"
          className="inline-flex items-center gap-2 text-sm tracking-wide hover:opacity-70 transition-opacity group"
        >
          View All Projects
          <ArrowRight className="h-4 w-4 transition-transform group-hover:translate-x-1" />
        </Link>
      </div>
    </Section>
  )
}
