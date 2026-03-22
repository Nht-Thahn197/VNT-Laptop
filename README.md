# VNT Laptop

VNT Laptop is a full-stack Laravel portfolio project that combines a laptop catalog, a technology blog, a contact funnel, and an admin CMS in one application.

The interface content is in Vietnamese because the target audience is local users. This README is written in English for recruiters and technical reviewers.

## Project Overview

The goal of this project was to build a realistic small-business web application instead of an isolated CRUD demo. Visitors can browse laptops, filter products, read review articles, and send contact requests. Administrators can sign in and manage products, categories, blog posts, and incoming leads from a protected dashboard.

## Main Features

### Public Website

- Responsive landing page with featured laptops, blog categories, and platform stats
- Laptop catalog with filters for category, brand, RAM, and price range
- Laptop detail pages with related products and linked content
- Blog listing with category filters, keyword search, popular posts, and slug-based detail pages
- Contact form that stores customer inquiries in the database
- User registration, login, and logout

### Admin Area

- Role-based admin access using custom middleware
- Dashboard with summary metrics for laptops, posts, users, and contacts
- CRUD management for categories
- CRUD management for laptops, including image upload and external image URL support
- CRUD management for blog posts, including automatic slug generation and laptop-to-post linking
- Contact inbox management

## Technical Highlights

- Laravel 12 monolith with Blade templates for fast, SEO-friendly server-rendered pages
- Eloquent relationships across `users`, `categories`, `laptops`, `posts`, `contacts`, and the `post_laptop` pivot table
- Tailwind CSS 4 and Vite for a custom responsive frontend
- File uploads handled through Laravel Storage
- Pagination and query-string based filtering on catalog and blog pages
- Role-based authorization for the admin panel
- Defensive auth logic that can rehash older password formats after login

## Tech Stack

- Backend: PHP 8.2, Laravel 12
- Frontend: Blade, Tailwind CSS 4, Vite, vanilla JavaScript
- Database: MySQL / MariaDB
- Tooling: Composer, npm, PHPUnit

## What This Project Demonstrates

- Building an end-to-end business application rather than isolated pages
- Designing a relational data model for both catalog content and editorial content
- Implementing authentication, authorization, validation, CRUD flows, and media handling
- Balancing public-facing UX with internal admin workflows
- Structuring a Laravel codebase in a maintainable way

## Important Routes

- `/` - home page
- `/laptops` - product catalog
- `/blog` - content hub
- `/lien-he` - contact page
- `/admin` - admin dashboard (admin role required)

## Local Setup

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL or MariaDB

### Recommended Environment

This project was developed in a XAMPP-style local environment, but it also works with a standard Laravel setup.

### Installation

1. Clone the repository.
2. Install PHP dependencies:

```bash
composer install
```

3. Install frontend dependencies:

```bash
npm install
```

4. Copy `.env.example` to `.env` and update the local configuration. For the fastest demo setup, use values similar to:

```env
APP_NAME="VNT Laptop"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vnt_laptop
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=public
```

5. Generate the application key:

```bash
php artisan key:generate
```

6. Create a MySQL database named `vnt_laptop`, then import:

- `database/vnt_laptop.sql`

7. Create the public storage symlink so the seeded images load correctly:

```bash
php artisan storage:link
```

8. Start the application:

```bash
php artisan serve
npm run dev
```

### Admin Access for Reviewers

The admin panel requires the `admin` role. The simplest way to test it locally is:

1. Register a new account through `/dang-ky`
2. Open the `users` table in MySQL
3. Change that account's `role` from `user` to `admin`
4. Sign in and visit `/admin`

## Project Structure

- `app/Http/Controllers` - public and admin request handling
- `app/Models` - core domain models and relationships
- `resources/views` - Blade layouts, pages, and reusable components
- `database/vnt_laptop.sql` - schema and sample data used by the current demo
- `storage/app/public` - sample uploaded images for laptops and posts

## Notes

- The current demo relies on the included SQL dump for the main business tables.
- Do not run a full `php artisan migrate` on top of the imported dump unless you first refactor the database setup, because existing tables will conflict.
- UI content is Vietnamese, while this README is English for recruiter review.
- Automated test coverage is currently minimal and would be a logical next step.

## Next Improvements

- Add full migration coverage for domain tables instead of relying on a SQL dump
- Expand automated tests for auth, filtering, and admin CRUD flows
- Add richer search and sorting for the laptop catalog
- Add deployment instructions and environment-specific configuration
