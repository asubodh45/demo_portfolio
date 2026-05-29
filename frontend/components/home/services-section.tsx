"use client"

import { Section, SectionHeader } from "@/components/section"
import { motion } from "framer-motion"
import type { Service } from "@/lib/api"

interface ServicesSectionProps {
  services: Service[]
}

export function ServicesSection({ services }: ServicesSectionProps) {
  return (
    <Section className="bg-secondary/50">
      <SectionHeader
        label="Services"
        title="What I do"
        description="Every project is unique, but my process always starts with strategy and ends with systems that scale."
      />

      <div className="grid md:grid-cols-3 gap-12 md:gap-8">
        {services.map((service, index) => (
          <motion.div
            key={service.id}
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.5, delay: index * 0.1 }}
            className="space-y-4"
          >
            <h3 className="font-serif text-2xl tracking-tight">
              {service.title}
            </h3>
            <p className="text-muted-foreground leading-relaxed">
              {service.description}
            </p>
            <ul className="pt-2 space-y-2">
              {service.deliverables.map((item) => (
                <li
                  key={item}
                  className="text-sm text-muted-foreground flex items-center gap-2"
                >
                  <span className="w-1 h-1 bg-muted-foreground rounded-full" />
                  {item}
                </li>
              ))}
            </ul>
          </motion.div>
        ))}
      </div>
    </Section>
  )
}
