export const skill = {
  name: 'skill' as const,
  title: 'Skill',
  type: 'document' as const,
  fields: [
    {
      name: 'name',
      title: 'Name',
      type: 'string',
    },
    {
      name: 'proficiency',
      title: 'Proficiency',
      type: 'string',
    },
  ],
} as const
