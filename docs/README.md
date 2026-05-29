# Prajesh Shakya — Portfolio Backend

This is the backend for Prajesh Shakya's portfolio website. The project consists of a Laravel REST API, a Filament admin panel for managing content, and a Next.js frontend that consumes the API. This document covers the overall architecture and the decisions made during development.

---

## Live Deployment

| | URL |
|---|---|
| **Frontend** | https://demo-portfolio-blush-phi.vercel.app |
| **Admin Panel** | https://demo-portfolio-b8on.onrender.com/admin |
| **API** | https://demo-portfolio-b8on.onrender.com/api/v1 |

Admin login: `admin@admin.com` / `password`

> **Note:** The backend runs on Render's free tier. If the first request is slow, wait up to 30 seconds for the server to wake from idle.

---

## What Was Built

The original demo site was a fully static Next.js frontend — all data was hardcoded in TypeScript files (`lib/projects.ts`) and components. The task was to build a real backend that powers it dynamically.

Here is what was delivered:

- A RESTful API with 11 endpoints covering all content on the site
- A PostgreSQL database with 11 tables and proper relationships
- An admin panel where content can be created, edited, and deleted without touching code
- Full integration with the Next.js frontend — all static data has been replaced with live API calls
- A working contact form that saves submissions to the database

---

## Tech Stack

| Layer | Technology | Why |
|---|---|---|
| Backend framework | Laravel 13 | Laravel is the most mature PHP framework available. It comes with built-in validation, an ORM, migrations, and a clean architecture that scales well. For an MVP that needs to be maintainable and extendable, it was the right call. |
| Database | PostgreSQL via Supabase | Supabase provides a managed PostgreSQL instance with a generous free tier. PostgreSQL handles JSON columns cleanly, which we used for `tags` and `deliverables`. It also gives us a production-ready database without any local setup. |
| Admin panel | Filament v5 | Filament is Laravel's standard admin solution — the equivalent of Django Admin for Python developers. Building a custom React-based admin panel would have taken weeks and is not what this task was evaluating. Filament ships with authentication, CRUD, file uploads, search, and filters out of the box. |
| Frontend | Next.js 15 | Already provided as the demo site. We integrated it rather than rebuilding it. |

---

## Key Decisions Worth Noting

**Sanity was not used.**
The original frontend contained Sanity configuration files (`/frontend/sanity/`). Sanity is a third-party headless CMS — using it would have meant outsourcing the backend to an external service rather than actually building one. We replaced it entirely with a proper Laravel backend and relational database. The Sanity files have been removed from the repository.

**The admin panel is on the backend, not the frontend.**
The task specified "admin/content management instructions" but did not require the admin panel to be built in React or Next.js. Filament, running at `/admin` on the Laravel server, is the industry-standard approach for Laravel applications and delivers a significantly better result than a custom-built panel would in the same timeframe.

**The public API has no authentication.**
This is intentional. The portfolio is a public website — there are no user accounts, no private data, and nothing that requires protecting. Adding token-based auth to public read endpoints would add complexity without purpose. The only write endpoint is the contact form, which has rate limiting via Laravel's built-in middleware and full input validation.

**Seeded demo projects have no cover images.**
File upload support is fully working — the project edit form has a cover image field and a gallery section. The six demo projects seeded into the database simply have no images attached yet. Upload a cover image on any project through the admin panel and it will appear on the frontend immediately. Note that on Render's free tier, uploaded files do not persist across deploys (the filesystem resets). For a production setup, configure an S3-compatible bucket by updating `FILESYSTEM_DISK` in the environment — the upload logic is already wired for it.

**The frontend notes page was broken.**
The original demo had a notes page that imported from a Supabase client that did not exist in the project. We rewrote it to fetch from the API, fixing a page that would have 500-errored on load.

---

## Documentation

- [Setup & Installation Guide](SETUP.md)
- [API Documentation](API.md)
- [Database Schema](DATABASE.md)
- [Content Management Guide](CONTENT_GUIDE.md)

---

## Quick Start (Local)

```bash
# 1. Set up the backend
cd backend
composer install
cp .env.example .env
# Fill in your database credentials in .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve

# 2. Set up the frontend
cd frontend
npm install --legacy-peer-deps
# Set NEXT_PUBLIC_API_URL in .env.local
npm run dev
```

Backend runs at `http://localhost:8000`
Frontend runs at `http://localhost:3000`
Admin panel at `http://localhost:8000/admin`
