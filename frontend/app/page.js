import { getProjects, getExperience, getSkills } from '@/lib/queries'

export default async function Home() {
  const projects = await getProjects()
  const experience = await getExperience()
  const skills = await getSkills()

  return (
    <main style={{ padding: '40px' }}>
      
      <h1>My Portfolio</h1>

      {/* PROJECTS */}
      <section>
        <h2>Projects</h2>
        {projects.map((project) => (
          <div key={project._id} style={{ marginBottom: '20px' }}>
            <h3>{project.title}</h3>
            <p>{project.description}</p>
            <a href={project.link} target="_blank">View Project</a>
          </div>
        ))}
      </section>

      {/* EXPERIENCE */}
      <section>
        <h2>Experience</h2>
        {experience.map((exp) => (
          <div key={exp._id}>
            <h3>{exp.role}</h3>
            <p>{exp.company} ({exp.year})</p>
          </div>
        ))}
      </section>

      {/* SKILLS */}
      <section>
        <h2>Skills</h2>
        <ul>
          {skills.map((skill) => (
            <li key={skill._id}>{skill.name}</li>
          ))}
        </ul>
      </section>

    </main>
  )
}