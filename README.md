# BlogHub – Blog Management System

A full-featured Blog Management System built with **Laravel 10**, **MySQL**, **Bootstrap 5**, and **jQuery/AJAX**.

> **JobYaari Assessment** – PHP/Laravel Developer Intern

---

## Live Demo

- **Website:** [https://project-d3nr3k1g9-jaswanth-jas-pngs-projects.vercel.app](https://project-d3nr3k1g9-jaswanth-jas-pngs-projects.vercel.app)
- **Admin Panel:** [https://project-d3nr3k1g9-jaswanth-jas-pngs-projects.vercel.app/admin/login](https://project-d3nr3k1g9-jaswanth-jas-pngs-projects.vercel.app/admin/login)
- **Admin Credentials:**
  - Email: `admin@bloghub.com`
  - Password: `admin123`

---

## Features

### Public Blog Pages
- Responsive blog listing with card layout (works on mobile & desktop)
- **AJAX-powered filtering** by category and date — **no page reload**
- **Live search** across title, excerpt, and content
- Paginated blog listing (9 posts per page)
- Full blog detail page with related posts sidebar
- Breadcrumb navigation

### Admin Panel
- Secure admin login with session authentication
- Dashboard with stats (total blogs, categories, monthly count)
- Full **CRUD** for blog posts:
  - Create post with title, content, excerpt, category, date, image upload
  - Edit existing posts with image replacement
  - Delete posts (with image cleanup from storage)
- Image upload with live preview before publishing
- Flash success/error messages

---

## Tech Stack

| Layer      | Technology                     |
|------------|--------------------------------|
| Backend    | PHP 8.1+, Laravel 10           |
| Database   | MySQL 8                        |
| Frontend   | HTML5, CSS3, Bootstrap 5.3     |
| JS/AJAX    | jQuery 3.7, Bootstrap JS       |
| Auth       | Laravel Guard (separate admin) |
| Storage    | Laravel File Storage           |

---

## Setup Instructions

### 1. Prerequisites
Install the following (all free):
- **PHP 8.1+** → [windows.php.net](https://windows.php.net/download/) (use VS16 x64 Thread Safe)
- **Composer** → [getcomposer.org](https://getcomposer.org/download/)
- **MySQL** → via [XAMPP](https://www.apachefriends.org/) or [Laragon](https://laragon.org/)
- **Git** → [git-scm.com](https://git-scm.com/)

### 2. Clone the Repository
```bash
git clone https://github.com/JASWANTH-JAS-PNG/Blog-management.git
cd Blog-management
```

### 3. Install Dependencies
```bash
composer install
```

### 4. Configure Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your MySQL credentials:
```
DB_DATABASE=blog_management
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Create Database
Open MySQL and run:
```sql
CREATE DATABASE blog_management;
```

### 6. Run Migrations & Seed Demo Data
```bash
php artisan migrate --seed
```

This creates all tables and seeds:
- 5 categories (Admit Card, Result, Sarkari Job, Syllabus, Answer Key)
- 1 admin account (admin@bloghub.com / admin123)
- 6 sample blog posts

### 7. Create Storage Symlink
```bash
php artisan storage:link
```

### 8. Run Development Server
```bash
php artisan serve
```

Open **http://localhost:8000** in your browser.

---

## Admin Panel Access

| URL                        | Description        |
|----------------------------|--------------------|
| `/admin/login`             | Admin login page   |
| `/admin/dashboard`         | Dashboard overview |
| `/admin/blogs`             | All blog posts     |
| `/admin/blogs/create`      | Create new post    |

**Default credentials:**
- Email: `admin@bloghub.com`
- Password: `admin123`

---

## Deployment (Free Hosting — Railway)

Railway is recommended because it supports Docker + MySQL and deploys automatically from GitHub.

### Steps:
1. Go to [railway.app](https://railway.app) → sign in with GitHub
2. Click **New Project → Deploy from GitHub repo** → select `Blog-management`
3. Railway detects `railway.toml` and starts the Docker build automatically
4. Click **+ New** → **Database** → **Add MySQL** to add a free database
5. In the service **Variables** tab, add these environment variables:

```
APP_URL=https://your-railway-url.railway.app
DB_HOST=     (copy from the MySQL plugin "Connect" tab)
DB_PORT=3306
DB_DATABASE= (copy from MySQL plugin)
DB_USERNAME= (copy from MySQL plugin)
DB_PASSWORD= (copy from MySQL plugin)
```

6. Click **Deploy** — Railway builds the Docker image, runs migrations, seeds demo data, and starts the server
7. Your live URL appears in the Railway dashboard under **Settings → Domains**

---

## Project Structure

```
blog-management/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── BlogController.php          # Public blog listing + AJAX
│   │   │   └── Admin/
│   │   │       ├── AuthController.php      # Admin login/logout
│   │   │       ├── BlogController.php      # Admin CRUD
│   │   │       └── DashboardController.php
│   │   └── Middleware/
│   │       └── AdminAuthenticate.php       # Admin guard middleware
│   └── Models/
│       ├── Blog.php
│       ├── Category.php
│       └── Admin.php
├── database/
│   ├── migrations/                         # DB schema
│   └── seeders/                            # Demo data
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php                   # Public layout
│   │   └── admin.blade.php                 # Admin layout
│   ├── blogs/
│   │   ├── index.blade.php                 # Blog listing + AJAX filter
│   │   ├── show.blade.php                  # Blog detail
│   │   └── partials/blog-cards.blade.php   # AJAX partial
│   └── admin/
│       ├── login.blade.php
│       ├── dashboard.blade.php
│       └── blogs/ (index, create, edit)
├── routes/web.php
└── config/auth.php                         # Admin guard config
```

---

## AJAX Filter Implementation

The blog listing page uses **jQuery AJAX** to filter without page reload:

```javascript
$.ajax({
    url: '{{ route("blogs.index") }}',
    method: 'GET',
    data: { category: currentCategory, date: currentDate, search: currentSearch, page: page },
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
    success: function(response) {
        $('#blog-list').html(response.html);
        $('#pagination-links').html(response.pagination);
    }
});
```

The server detects `$request->ajax()` and returns JSON with rendered HTML partials.

---

Made with ❤️ for the JobYaari Developer Assessment.
