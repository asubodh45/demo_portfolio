import { Metadata } from "next"
import { Navbar } from "@/components/navbar"
import { Footer } from "@/components/footer"
import { fetchNotes } from "@/lib/api"
import Link from "next/link"

export const metadata: Metadata = {
  title: "Notes — Prajesh Shakya",
  description: "Thoughts on branding, design, and building lasting identities.",
}

export default async function NotesPage() {
  const notes = await fetchNotes()

  return (
    <>
      <Navbar />
      <main className="pt-20">
        <section className="py-24 md:py-32">
          <div className="max-w-7xl mx-auto px-6 lg:px-8">
            <div className="max-w-2xl mb-16">
              <span className="block text-xs uppercase tracking-widest text-muted-foreground mb-4">
                Notes
              </span>
              <h1 className="font-serif text-4xl md:text-5xl tracking-tight">
                Thoughts on brand
              </h1>
              <p className="mt-4 text-lg text-muted-foreground">
                Ideas, observations, and lessons from building brand identities.
              </p>
            </div>

            {notes.length === 0 ? (
              <p className="text-muted-foreground">No notes yet.</p>
            ) : (
              <div className="divide-y divide-border">
                {notes.map((note) => (
                  <article key={note.slug} className="py-12">
                    <div className="grid lg:grid-cols-5 gap-8">
                      <div className="lg:col-span-2">
                        {note.published_at && (
                          <time className="text-xs uppercase tracking-widest text-muted-foreground">
                            {new Date(note.published_at).toLocaleDateString(
                              "en-US",
                              { year: "numeric", month: "long", day: "numeric" }
                            )}
                          </time>
                        )}
                      </div>
                      <div className="lg:col-span-3">
                        <h2 className="font-serif text-2xl md:text-3xl tracking-tight mb-4">
                          {note.title}
                        </h2>
                        {note.excerpt && (
                          <p className="text-muted-foreground leading-relaxed">
                            {note.excerpt}
                          </p>
                        )}
                      </div>
                    </div>
                  </article>
                ))}
              </div>
            )}
          </div>
        </section>
      </main>
      <Footer />
    </>
  )
}
