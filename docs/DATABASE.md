# Database Schema

The database uses PostgreSQL and consists of 11 tables. This document covers the structure of each table, the relationships between them, and the reasoning behind key design decisions.

---

## Overview

```
users
categories
    └── projects
            └── project_images
services
process_steps
skills
experiences
site_settings
notes
contact_submissions
```

Projects are the central entity. Everything else is either standalone content (services, process steps, skills) or administrative data (settings, contact submissions).

---

## Tables

### `users`

Stores admin panel users. Currently only one user exists — the site owner.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `name` | string | Display name |
| `email` | string | Login email (unique) |
| `password` | string | Bcrypt-hashed password |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

### `categories`

Project categories used for filtering on the portfolio page.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `name` | string | Category name, e.g. "Brand Identity" |
| `slug` | string | URL-safe version, e.g. "brand-identity" (unique) |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

### `projects`

The main content table. Each row is a portfolio case study.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `title` | string | Project name |
| `slug` | string | URL slug — used in `/projects/{slug}` (unique) |
| `tagline` | string | Short one-line description |
| `description` | text | General description (optional) |
| `overview` | text | Case study overview |
| `problem` | text | The challenge or problem the project solved |
| `approach` | text | How the problem was approached |
| `solution` | text | What was designed or built |
| `outcome` | text | Results and impact |
| `category_id` | bigint | Foreign key → `categories.id` (nullable, nulls on delete) |
| `cover_image` | string | Path to the cover image file |
| `year` | string | Year the project was completed |
| `client` | string | Client name |
| `tags` | json | Array of tag strings, e.g. `["Logo", "Packaging"]` |
| `featured` | boolean | Whether to show on the home page (default `false`) |
| `published` | boolean | Whether to expose via the API (default `true`) |
| `sort_order` | integer | Controls display order (lower = first) |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

**Why JSON for tags?**
Tags are free-form labels that don't need a separate table and pivot relationship. Storing them as a JSON array keeps the schema simple while still allowing the frontend to iterate and display them.

---

### `project_images`

Gallery images belonging to a project. A project can have any number of gallery images.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `project_id` | bigint | Foreign key → `projects.id` (cascades on delete) |
| `url` | string | Path to the image file |
| `alt` | string | Alt text for accessibility |
| `sort_order` | integer | Controls gallery order |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

### `services`

The services offered — shown in the Services section on the home page.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `title` | string | Service name |
| `description` | text | What the service includes |
| `deliverables` | json | Array of deliverable strings, e.g. `["Logo System", "Guidelines"]` |
| `icon` | string | Icon identifier (Heroicon name) |
| `published` | boolean | Whether to show via the API |
| `sort_order` | integer | Display order |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

### `process_steps`

The steps in Prajesh's design process — shown in the Process section on the home page.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `step_number` | integer | The step number (1, 2, 3, 4) |
| `title` | string | Step name, e.g. "Discovery" |
| `description` | text | What happens in this step |
| `sort_order` | integer | Display order |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

### `skills`

Tools and skills displayed on the About page.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `name` | string | Skill or tool name |
| `category` | string | Groups skills, e.g. "Design Tool" or "Skill" |
| `sort_order` | integer | Display order |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

### `experiences`

Work history entries displayed on the About page.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `company` | string | Company or organisation name |
| `role` | string | Job title |
| `description` | text | What was done in this role |
| `start_date` | string | e.g. "Jan 2022" |
| `end_date` | string | e.g. "Dec 2021" — null if current |
| `is_current` | boolean | Whether this is the current position |
| `sort_order` | integer | Display order |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

### `site_settings`

Global site configuration stored as key-value pairs.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `key` | string | Setting name (unique), e.g. `site_name` |
| `value` | text | Setting value |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

**Current settings keys:**

| Key | Example Value |
|---|---|
| `site_name` | Prajesh Shakya |
| `tagline` | Brand Identity Designer |
| `bio` | I craft brand identities... |
| `email` | hello@prajeshshakya.com |
| `instagram` | https://instagram.com/prajeshshakya |
| `behance` | https://behance.net/prajeshshakya |
| `linkedin` | https://linkedin.com/in/prajeshshakya |
| `available_for_work` | true |

**Why key-value instead of a single-row config table?**
A key-value table is easier to extend — adding a new setting is just inserting a row rather than writing a migration to add a column. The API returns settings as a flat object, so the frontend consumption is clean either way.

---

### `notes`

Short-form written content — thoughts and observations about branding and design.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `title` | string | Note title |
| `slug` | string | URL slug (unique) |
| `excerpt` | text | Short preview text |
| `content` | text | Full note content |
| `cover_image` | string | Optional cover image path |
| `published` | boolean | Whether to show via the API |
| `published_at` | timestamp | Publication date |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

### `contact_submissions`

Stores every message submitted through the contact form on the site.

| Column | Type | Description |
|---|---|---|
| `id` | bigint | Primary key |
| `name` | string | Sender's name |
| `email` | string | Sender's email address |
| `subject` | string | Optional subject line |
| `message` | text | The message body |
| `is_read` | boolean | Mark as read in the admin panel (default `false`) |
| `created_at` | timestamp | When the message was submitted |
| `updated_at` | timestamp | |

---

## Relationships

```
Category  has many  Projects
Project   belongs to  Category
Project   has many  ProjectImages
ProjectImage  belongs to  Project
```

All other tables are standalone with no foreign key relationships.

The `category_id` on `projects` is nullable with `nullOnDelete`, meaning if a category is deleted, the projects in it are not deleted — their `category_id` is simply set to null. This prevents accidental data loss.

The `project_id` on `project_images` cascades on delete — if a project is deleted, all its gallery images are deleted too. This is intentional because images without a parent project are orphaned data.

---

## Design Decisions

**Separate `project_images` table instead of a JSON column**
Gallery images need their own sort order, alt text, and potentially more metadata in the future (caption, type, etc.). A separate table with a foreign key is more flexible than a JSON array and allows the admin panel to manage images individually through a repeater field.

**`published` flag on multiple tables**
Projects, services, and notes all have a `published` boolean. This lets the admin create drafts and preview content before making it live, without exposing incomplete content through the API.

**`sort_order` on most tables**
Display order is controlled by a numeric column rather than insertion order. This makes it trivial to reorder content through the admin panel without needing to delete and recreate records.
