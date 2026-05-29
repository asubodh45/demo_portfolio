import { Navbar } from "@/components/navbar"
import { Footer } from "@/components/footer"
import { HeroSection } from "@/components/home/hero-section"
import { IntroSection } from "@/components/home/intro-section"
import { SelectedWorkSection } from "@/components/home/selected-work-section"
import { ServicesSection } from "@/components/home/services-section"
import { ProcessSection } from "@/components/home/process-section"
import { CTABlock } from "@/components/cta-block"
import { fetchProjects, fetchServices, fetchProcessSteps } from "@/lib/api"

export default async function HomePage() {
  const [projects, services, steps] = await Promise.all([
    fetchProjects(),
    fetchServices(),
    fetchProcessSteps(),
  ])

  const featuredProjects = projects.filter((p) => p.featured)

  return (
    <>
      <Navbar />
      <main>
        <HeroSection />
        <IntroSection />
        <SelectedWorkSection projects={featuredProjects} />
        <ServicesSection services={services} />
        <ProcessSection steps={steps} />
        <CTABlock />
      </main>
      <Footer />
    </>
  )
}
