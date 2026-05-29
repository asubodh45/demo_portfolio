"use client"

import Link from "next/link"
import { Section, SectionHeader } from "@/components/section"
import { ProjectCard, ProjectCardLarge } from "@/components/project-card"
import type { Project } from "@/lib/api"
import { ArrowRight } from "lucide-react"

interface SelectedWorkSectionProps {
  projects: Project[]
}

export function SelectedWorkSection({ projects }: SelectedWorkSectionProps) {
  const display = projects.slice(0, 4)
  const [featured, ...rest] = display

  if (!featured) return null

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
