"use client"

import { Section, SectionHeader } from "@/components/section"
import { motion } from "framer-motion"
import type { ProcessStep } from "@/lib/api"

interface ProcessSectionProps {
  steps: ProcessStep[]
}

export function ProcessSection({ steps }: ProcessSectionProps) {
  return (
    <Section>
      <SectionHeader
        label="Process"
        title="How we work together"
        description="A proven methodology that transforms insight into identity."
      />

      <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-12 md:gap-8">
        {steps.map((step, index) => (
          <motion.div
            key={step.id}
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.5, delay: index * 0.1 }}
            className="space-y-4"
          >
            <span className="block font-serif text-4xl text-muted-foreground/30">
              {String(step.step_number).padStart(2, "0")}
            </span>
            <h3 className="font-serif text-xl tracking-tight">{step.title}</h3>
            <p className="text-sm text-muted-foreground leading-relaxed">
              {step.description}
            </p>
          </motion.div>
        ))}
      </div>
    </Section>
  )
}
