import React from 'react'
import { defineConfig } from 'sanity'
import { structureTool } from 'sanity/structure'
import { visionTool } from '@sanity/vision'
import { schemaTypes } from '../schemas'
import { structure } from './structure'

export default defineConfig({
  name: 'prajesh-shakya-studio',
  title: 'Prajesh Shakya — CMS',
  
  projectId: process.env.NEXT_PUBLIC_SANITY_PROJECT_ID!,
  dataset: process.env.NEXT_PUBLIC_SANITY_DATASET!,
  
  plugins: [
    structureTool({ structure }),
    visionTool(),
  ],
  
  schema: {
    types: schemaTypes,
  },
  
  studio: {
    components: {
      // Custom logo component
      logo: () =>
        React.createElement('span', { style: { fontWeight: 600, fontSize: '14px' } }, 'PS Studio'),
    },
  },
})