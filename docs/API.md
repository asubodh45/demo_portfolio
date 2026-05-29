# API Documentation

The backend exposes a versioned REST API at `/api/v1`. All endpoints return JSON and follow a consistent response envelope. The API is read-only except for the contact form submission endpoint.

---

## Base URL

```
http://localhost:8000/api/v1
```

In production, replace this with your deployed backend URL.

---

## Response Format

Every response, whether successful or an error, follows this structure:

```json
{
  "success": true,
  "message": "A human-readable message",
  "data": {}
}
```

| Field | Type | Description |
|---|---|---|
| `success` | boolean | `true` for successful requests, `false` for errors |
| `message` | string | Short description of the result |
| `data` | object or array | The actual payload — `null` for errors or empty responses |

---

## Endpoints

### Projects

#### List all projects

```
GET /api/v1/projects
```

Returns all published projects ordered by `sort_order`.

**Response**

```json
{
  "success": true,
  "message": "Projects retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Luminary Coffee",
      "slug": "luminary-coffee",
      "tagline": "A premium brand identity for a specialty coffee roaster",
      "category": "Brand Identity",
      "thumbnail": null,
      "year": "2024",
      "client": "Luminary Coffee Co.",
      "tags": ["Brand Identity", "Logo", "Packaging"],
      "featured": true,
      "overview": "Complete brand identity system for Luminary Coffee...",
      "problem": "Luminary needed to stand apart in a saturated premium coffee market...",
      "approach": "We began with an extensive discovery phase...",
      "solution": "A warm golden identity system anchored by a custom logotype...",
      "outcome": "The rebrand launched to immediate positive reception...",
      "images": []
    }
  ]
}
```

---

#### Get a single project

```
GET /api/v1/projects/{slug}
```

Returns a single project by its slug, including its gallery images.

**Parameters**

| Parameter | Type | Description |
|---|---|---|
| `slug` | string | The project's URL slug, e.g. `luminary-coffee` |

**Response**

Same structure as the list endpoint but returns a single object in `data`.

**Error (project not found)**

```json
{
  "success": false,
  "message": "Project not found",
  "data": null
}
```

Status: `404`

---

### Services

#### List all services

```
GET /api/v1/services
```

Returns all published services ordered by `sort_order`.

**Response**

```json
{
  "success": true,
  "message": "Services retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Brand Identity",
      "description": "Complete visual identity systems including logo design...",
      "deliverables": ["Logo System", "Color Palette", "Typography", "Guidelines"],
      "icon": "heroicon-o-identification",
      "sort_order": 1
    }
  ]
}
```

---

### Process Steps

#### List all process steps

```
GET /api/v1/process-steps
```

Returns all process steps ordered by `sort_order`.

**Response**

```json
{
  "success": true,
  "message": "Process steps retrieved successfully",
  "data": [
    {
      "id": 1,
      "step_number": 1,
      "title": "Discovery",
      "description": "We start with a deep dive into your business...",
      "sort_order": 1
    }
  ]
}
```

---

### Skills

#### List all skills

```
GET /api/v1/skills
```

Returns all skills ordered by `sort_order`.

**Response**

```json
{
  "success": true,
  "message": "Skills retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Adobe Illustrator",
      "category": "Design Tool",
      "sort_order": 1
    }
  ]
}
```

---

### Experience

#### List all experience entries

```
GET /api/v1/experience
```

Returns all experience records ordered by `sort_order`.

**Response**

```json
{
  "success": true,
  "message": "Experience retrieved successfully",
  "data": [
    {
      "id": 1,
      "company": "Freelance",
      "role": "Brand Identity Designer",
      "description": "Working with clients globally...",
      "start_date": "Jan 2022",
      "end_date": null,
      "is_current": true,
      "sort_order": 1
    }
  ]
}
```

---

### Notes

#### List all notes

```
GET /api/v1/notes
```

Returns all published notes ordered by `published_at` descending.

**Response**

```json
{
  "success": true,
  "message": "Notes retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "On Building a Brand That Lasts",
      "slug": "on-building-a-brand-that-lasts",
      "excerpt": "Brand identity is not just about how something looks...",
      "content": "Brand identity is not just about how something looks...",
      "cover_image": null,
      "published_at": "2026-05-29"
    }
  ]
}
```

---

#### Get a single note

```
GET /api/v1/notes/{slug}
```

Returns a single note by its slug.

**Parameters**

| Parameter | Type | Description |
|---|---|---|
| `slug` | string | The note's URL slug |

---

### Categories

#### List all categories

```
GET /api/v1/categories
```

Returns all project categories.

**Response**

```json
{
  "success": true,
  "message": "Categories retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Brand Identity",
      "slug": "brand-identity"
    }
  ]
}
```

---

### Site Settings

#### Get all settings

```
GET /api/v1/settings
```

Returns all site settings as a flat key-value object.

**Response**

```json
{
  "success": true,
  "message": "Settings retrieved successfully",
  "data": {
    "site_name": "Prajesh Shakya",
    "tagline": "Brand Identity Designer",
    "bio": "I craft brand identities that help businesses stand out...",
    "email": "hello@prajeshshakya.com",
    "instagram": "https://instagram.com/prajeshshakya",
    "behance": "https://behance.net/prajeshshakya",
    "linkedin": "https://linkedin.com/in/prajeshshakya",
    "available_for_work": "true"
  }
}
```

---

### Contact

#### Submit a contact message

```
POST /api/v1/contact
```

Accepts a contact form submission and saves it to the database. The submission will appear in the admin panel under **Contact Submissions**.

**Request Body**

```json
{
  "name": "Jane Smith",
  "email": "jane@example.com",
  "message": "I would love to discuss a branding project."
}
```

| Field | Type | Required | Rules |
|---|---|---|---|
| `name` | string | Yes | Max 255 characters |
| `email` | string | Yes | Must be a valid email address |
| `message` | string | Yes | Minimum 10 characters |

**Success Response**

```json
{
  "success": true,
  "message": "Your message has been sent. Thank you!",
  "data": null
}
```

Status: `201`

**Validation Error Response**

```json
{
  "success": false,
  "message": "Validation failed",
  "data": {
    "email": ["The email field must be a valid email address."],
    "message": ["The message field must be at least 10 characters."]
  }
}
```

Status: `422`

---

## Error Handling

All errors follow the same envelope format with `success: false`. Common HTTP status codes used:

| Status | Meaning |
|---|---|
| `200` | Success |
| `201` | Created (contact form submission) |
| `404` | Resource not found |
| `422` | Validation failed — check the `data` field for field-level errors |
| `500` | Server error |

---

## Notes on Design

- All list endpoints return only **published** records. Drafts created in the admin panel are not exposed through the API until marked as published.
- The `images` field on projects is an array of image URLs. It will be empty until images are uploaded through the admin panel.
- The `thumbnail` field maps from the `cover_image` column in the database — this aliasing happens in the API resource layer so the frontend receives a consistent field name.
- The settings endpoint returns a flat object (not an array) since key-value pairs are more practical to consume on the frontend.
