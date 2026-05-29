# Content Management Guide

This guide is for managing the content on your portfolio website. You do not need any coding knowledge to use the admin panel — everything can be updated through a simple interface in your browser.

---

## Getting Into the Admin Panel

Open your browser and go to:

```
https://demo-portfolio-b8on.onrender.com/admin
```

Log in with your email and password. Once you're in, you'll see the sidebar on the left with all the sections you can manage.

> If you are running the site locally for testing, the address is `http://localhost:8000/admin`.

---

## Projects

Projects are the most important part of your portfolio. Each project is a case study with a title, images, and a breakdown of the work.

### Adding a new project

1. Click **Projects** in the left sidebar
2. Click the **New Project** button in the top right
3. Fill in the fields (explained below)
4. Click **Save**

### Project fields explained

**Basic Info**

- **Title** — The project name, e.g. "Luminary Coffee"
- **Slug** — This fills in automatically from the title. It is the URL for the project, e.g. `/projects/luminary-coffee`. You can leave this as-is.
- **Tagline** — One sentence that describes the project, shown as a subtitle
- **Category** — Choose from the existing categories (Brand Identity, Logo Design, etc.)

**Case Study** — This is the written content that appears on the project detail page

- **Overview** — A short summary of the project and what was created
- **Challenge** — What problem the client had before you started
- **Approach** — How you thought about solving the problem
- **Solution** — What you actually designed and delivered
- **Outcome** — The results — what changed for the client after the project

**Details**

- **Client** — The client's name or company
- **Year** — The year the project was completed
- **Tags** — Keywords for the project. Type a word and press Enter to add it. Examples: "Logo", "Packaging", "Typography"
- **Cover Image** — The main image that appears in the project grid and at the top of the case study. Upload a high-quality image here.

**Gallery** — Additional images that appear further down the project page. Click **Add Image**, upload the file, and add alt text describing what the image shows (this helps with accessibility and search engines).

**Visibility**

- **Featured** — Turn this on to show the project on the home page in the Selected Work section. Only your best 3–4 projects should be featured.
- **Published** — Turn this off if you want to hide a project from the site without deleting it. Useful for drafts.
- **Sort Order** — Controls the order projects appear in. Lower numbers come first. So if you want a project to appear first, give it a sort order of 1.

### Editing an existing project

1. Click **Projects** in the sidebar
2. Find the project in the table
3. Click the **Edit** button on the right side of the row
4. Make your changes
5. Click **Save**

### Deleting a project

Click the **Delete** button next to any project in the table. You will be asked to confirm. Deleting a project also deletes all its gallery images permanently.

---

## Services

Services appear in the "What I do" section on the home page.

### Fields

- **Title** — The service name, e.g. "Brand Identity"
- **Description** — A paragraph explaining what this service includes
- **Deliverables** — A list of what the client receives. Type each item and press Enter. Examples: "Logo System", "Color Palette", "Brand Guidelines"
- **Sort Order** — Controls the left-to-right order the services appear

---

## Process Steps

Process steps appear in the "How we work together" section on the home page. These explain your design process to potential clients.

### Fields

- **Step Number** — The number shown above the step (1, 2, 3, 4)
- **Title** — The step name, e.g. "Discovery"
- **Description** — One or two sentences explaining what happens in this step
- **Sort Order** — Controls the order they appear

---

## Skills

Skills appear on the About page. These are your tools and areas of expertise.

### Fields

- **Name** — The skill or tool name, e.g. "Adobe Illustrator" or "Typography"
- **Category** — Either "Design Tool" or "Skill" — this groups them on the page
- **Sort Order** — Display order

---

## Experience

Work history entries on the About page.

### Fields

- **Company** — The company or organisation name
- **Role** — Your job title there
- **Description** — A sentence or two about what you did
- **Start Date** — Written as month and year, e.g. "Jan 2022"
- **End Date** — Leave blank if this is your current position
- **Is Current** — Turn this on if this is your current role

---

## Notes

Notes are short written pieces — thoughts on branding, design observations, or anything you want to share. They appear on the Notes page.

### Fields

- **Title** — The note title
- **Slug** — Auto-generated from the title. This is the URL for the note.
- **Excerpt** — A one or two sentence preview shown in the notes list
- **Content** — The full written content of the note
- **Published** — Turn this on when you're ready for the note to go live
- **Published At** — The date shown on the note. Defaults to today.

---

## Site Settings

Site Settings are the global details about you and your site. These are used in various places across the website.

To update them:

1. Click **Site Settings** in the sidebar
2. Click the **Edit** button next to the setting you want to change
3. Update the value
4. Click **Save**

### Settings explained

| Setting | What it controls |
|---|---|
| `site_name` | Your name as it appears in the site header and browser tab |
| `tagline` | The short description under your name, e.g. "Brand Identity Designer" |
| `bio` | The paragraph about you on the home page |
| `email` | Your contact email shown on the contact page |
| `instagram` | Your Instagram profile URL |
| `behance` | Your Behance profile URL |
| `linkedin` | Your LinkedIn profile URL |
| `available_for_work` | Set to "true" or "false" — controls whether the site shows you are available for new projects |

---

## Contact Submissions

Every time someone fills out the contact form on your site, the message is saved here. You can see the sender's name, email, and message.

- Click **Contact Submissions** in the sidebar to see all messages
- The **Is Read** column shows whether you have reviewed the message
- You can mark messages as read and delete old ones you no longer need

---

## A Few Things to Know

**Changes are live immediately.** As soon as you save something in the admin panel, it is visible on the website. There is no separate publish step for most content (except the Published toggle on projects and notes).

**Images are stored on the server.** When you upload a cover image or gallery image, it is saved on the hosting server. Make sure your hosting provider has enough storage space if you plan to upload a lot of high-resolution images.

**The sort order controls everything.** If you want to change the order that projects, services, or process steps appear on the site, just update their sort order numbers. Lower number = appears first.

**Deleting is permanent.** There is no recycle bin or undo. If you delete a project or any other content, it is gone. When in doubt, use the Published toggle to hide content rather than deleting it.
