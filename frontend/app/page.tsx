import { Navbar } from "@/components/navbar"
import { Footer } from "@/components/footer"
import { HeroSection } from "@/components/home/hero-section"
import { IntroSection } from "@/components/home/intro-section"
import { SelectedWorkSection } from "@/components/home/selected-work-section"
import { ServicesSection } from "@/components/home/services-section"
import { ProcessSection } from "@/components/home/process-section"
import { CTABlock } from "@/components/cta-block"

export default function HomePage() {
  return (
    <>
      <Navbar />
      <main>
        <HeroSection />
        <IntroSection />
        <SelectedWorkSection />
        <ServicesSection />
        <ProcessSection />
        <CTABlock />
      </main>
      <Footer />
    </>
  )
}
