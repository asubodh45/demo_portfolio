# Setup & Installation Guide

This guide walks you through getting the project running locally from scratch. It covers both the backend API and the frontend.

---

## Prerequisites

Before you start, make sure you have the following installed:

- **PHP 8.3+** — [php.net](https://www.php.net/downloads)
- **Composer** — [getcomposer.org](https://getcomposer.org)
- **Node.js 18+** — [nodejs.org](https://nodejs.org)
- **npm** (comes with Node.js)
- A **PostgreSQL database** — we used [Supabase](https://supabase.com) (free tier works fine)

On Windows, [Laragon](https://laragon.org) is the easiest way to get PHP and Composer set up together.

> **Important for Windows users:** Make sure `pdo_pgsql` is enabled in your `php.ini`. Open the file, find `;extension=pdo_pgsql` and remove the semicolon at the start. Restart your server after saving.

---

## Backend Setup

### 1. Install dependencies

```bash
cd backend
composer install
```

### 2. Create your environment file

```bash
cp .env.example .env
```

Then open `.env` and fill in your database details:

```env
APP_NAME="Prajesh Web"
APP_URL=http://localhost:8000
FRONTEND_URL=http://localhost:3000

DB_CONNECTION=pgsql
DB_HOST=your-database-host
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

If you are using Supabase, go to your project dashboard, open **Project Settings → Database**, and use the **Session Pooler** connection details (not the direct connection). The session pooler works on IPv4 networks.

### 3. Generate the application key

```bash
php artisan key:generate
```

### 4. Run migrations

This creates all the database tables.

```bash
php artisan migrate
```

### 5. Seed demo data

This populates the database with sample projects, services, process steps, skills, and experience so the frontend has something to display.

```bash
php artisan db:seed
```

### 6. Create the storage symlink

This is needed for file uploads to work through the admin panel.

```bash
php artisan storage:link
```

### 7. Start the server

```bash
php artisan serve
```

The API is now running at `http://localhost:8000/api/v1` and the admin panel at `http://localhost:8000/admin`.

---

## Frontend Setup

### 1. Install dependencies

```bash
cd frontend
npm install --legacy-peer-deps
```

The `--legacy-peer-deps` flag is needed because the frontend has some package version conflicts that do not affect functionality.

### 2. Create your environment file

Create a file called `.env.local` in the `frontend` directory:

```env
NEXT_PUBLIC_API_URL=http://localhost:8000/api/v1
```

This tells the frontend where to find the API.

### 3. Start the development server

```bash
npm run dev
```

The frontend is now running at `http://localhost:3000`.

---

## Admin Panel Login

**Live (deployed):** https://demo-portfolio-b8on.onrender.com/admin

**Local:** `http://localhost:8000/admin`

Log in with:

- **Email:** `admin@admin.com`
- **Password:** `password`

Change the password after your first login in a real deployment.

---

## Environment Variables Reference

### Backend (`.env`)

| Variable | Description |
|---|---|
| `APP_KEY` | Generated automatically by `php artisan key:generate` |
| `APP_URL` | The URL where the backend runs |
| `FRONTEND_URL` | Used for CORS — must match where the frontend runs |
| `DB_HOST` | Your PostgreSQL host |
| `DB_PORT` | PostgreSQL port (default `5432`) |
| `DB_DATABASE` | Database name (usually `postgres` on Supabase) |
| `DB_USERNAME` | Database username |
| `DB_PASSWORD` | Database password |

### Frontend (`.env.local`)

| Variable | Description |
|---|---|
| `NEXT_PUBLIC_API_URL` | Full base URL of the API, e.g. `http://localhost:8000/api/v1` |

---

## Common Issues

**`could not find driver` error when running migrations**
PostgreSQL driver is not enabled. Open your `php.ini`, find `;extension=pdo_pgsql`, remove the semicolon, and restart your server.

**`could not translate host name` when connecting to Supabase**
You are using the direct database host which is IPv6 only. Switch to the Session Pooler host from the Supabase dashboard instead.

**Frontend shows empty sections**
The backend server is not running, or `NEXT_PUBLIC_API_URL` in `.env.local` is pointing to the wrong address.

**`npm install` fails with peer dependency errors**
Run `npm install --legacy-peer-deps` instead.
