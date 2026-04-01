# 🎓 Student Management System

> A university-level admission management system built with Laravel 12, MySQL and Tailwind CSS.

---

## 📌 About This Project

This is a full-featured Student Management System built as a portfolio project to demonstrate modern PHP and Laravel development skills. The system allows university administrators to manage student admission records with full CRUD operations, authentication, data visualization and PDF export functionality.

---

## ✨ Features

| Feature | Description |
|---|---|
| 🔐 Authentication | Secure login and registration via Laravel Breeze |
| 📊 Dashboard | Live stats with Chart.js doughnut and bar charts |
| 👨‍🎓 Student CRUD | Create, Read, Update and Delete student records |
| 🔍 Search & Filter | Filter by name, email, status, gender, program and GPA range |
| ✅ Form Validation | All fields required with server-side validation and error messages |
| 🎂 Age Validation | Date of birth must be at least 18 years ago |
| 📄 PDF Export | Download full student list as a formatted PDF |
| 📱 Responsive Design | Clean UI that works on desktop, tablet and mobile |

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Language | PHP 8.2 |
| Database | MySQL |
| Frontend | Blade Templates + Tailwind CSS |
| Authentication | Laravel Breeze |
| Charts | Chart.js 4.4 |
| PDF Generation | barryvdh/laravel-dompdf |
| Build Tool | Vite 7 |
| Local Server | XAMPP (Apache) |

---

## 📁 Project Structure

```
student-system/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php     ← Dashboard stats + chart data
│   │   └── StudentController.php       ← Full CRUD, search, filter, PDF export
│   └── Models/
│       └── Student.php                 ← Student model with fillable + casts
├── database/
│   ├── migrations/
│   │   └── ..._create_students_table.php
│   └── seeders/
│       └── StudentSeeder.php           ← 6 sample students
├── resources/views/
│   ├── dashboard.blade.php             ← Stats cards + Chart.js charts
│   └── students/
│       ├── index.blade.php             ← Student list + search + filter
│       ├── create.blade.php            ← Add student form
│       ├── edit.blade.php              ← Edit student form
│       ├── show.blade.php              ← Student profile view
│       ├── _form.blade.php             ← Reusable form partial
│       └── pdf.blade.php               ← PDF export template
└── routes/
    └── web.php                         ← All application routes
```

---

## ⚙️ Installation & Setup

### Requirements
- PHP 8.2+
- Composer
- MySQL
- Node.js & NPM
- XAMPP or any local server

### Step 1 — Download the Project
Download or copy the project into your web server directory:
```
C:\xampp\htdocs\student-system
```

### Step 2 — Install PHP Dependencies
```bash
composer install
```

### Step 3 — Install Node Dependencies
```bash
npm install
```

### Step 4 — Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_system
DB_USERNAME=root
DB_PASSWORD=
```

### Step 5 — Create Database
Open phpMyAdmin and create a database named `student_system`.

### Step 6 — Run Migrations & Seed Data
```bash
php artisan migrate
php artisan db:seed --class=StudentSeeder
```

### Step 7 — Build Assets
```bash
npm run build
```

### Step 8 — Start the Server
```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` and register an account to get started.

---

## 🗄️ Database Schema

### `students` table

| Column | Type | Rules |
|---|---|---|
| id | BIGINT | Primary key, auto increment |
| name | VARCHAR(255) | Required |
| email | VARCHAR(255) | Required, unique |
| phone | VARCHAR(20) | Required |
| program | VARCHAR(255) | Required |
| status | ENUM | pending / admitted / rejected |
| gender | VARCHAR | male / female / other |
| date_of_birth | DATE | Required, must be 18+ years ago |
| gpa | DECIMAL(3,2) | Required, between 0.0 and 4.0 |
| address | TEXT | Required |
| created_at | TIMESTAMP | Auto |
| updated_at | TIMESTAMP | Auto |

---

## 🔐 Authentication & Security

- **Laravel Breeze** handles registration, login and logout
- All student routes are protected by the `auth` middleware
- Mass assignment protection via `$fillable` in the Student model
- Form validation runs server-side before any data is saved
- Unique email constraint prevents duplicate student records

---

## 📊 Dashboard Charts

Two Chart.js charts are displayed on the dashboard:

- **Doughnut Chart** — Visualizes the ratio of admitted, pending and rejected students
- **Bar Chart** — Shows the number of students per program

Chart data is calculated in `DashboardController` using Eloquent queries and passed to the view as JSON.

---

## 🔍 Search & Filter System

The student list supports multiple simultaneous filters:

- **Text search** — searches name and email fields
- **Status filter** — admitted, pending or rejected
- **Gender filter** — male, female or other
- **Program filter** — partial match search
- **GPA range** — minimum and maximum GPA values

All filters use Laravel's query builder chaining and persist across paginated pages via `withQueryString()`.

---

## 📄 PDF Export

Clicking **Export PDF** on the student list page downloads a formatted A4 landscape PDF containing:

- Header with generation date and total record count
- Summary stats (total, admitted, pending, rejected)
- Full student table with colored status badges
- Generated using `barryvdh/laravel-dompdf`

---

## 🚀 Usage Guide

| Action | URL |
|---|---|
| Login | `/login` |
| Dashboard | `/dashboard` |
| All Students | `/students` |
| Add Student | `/students/create` |
| View Student | `/students/{id}` |
| Edit Student | `/students/{id}/edit` |
| Export PDF | `/students/export/pdf` |

---

## 🧠 Laravel Concepts Demonstrated

- **MVC Architecture** — Clean separation of Models, Views and Controllers
- **Eloquent ORM** — Database queries using Laravel's object-relational mapper
- **Route Model Binding** — Automatic model injection from URL parameters
- **Resource Controllers** — RESTful controller with all 7 standard methods
- **Form Validation** — Request validation with custom error messages
- **Blade Templating** — Reusable components, layouts and partials
- **Database Migrations** — Version-controlled database schema management
- **Database Seeding** — Sample data generation for development
- **Middleware** — Route protection using authentication middleware
- **Pagination** — Built-in Laravel pagination with filter persistence
- **Query Builder Chaining** — Dynamic SQL query construction
- **File Generation** — PDF creation using DomPDF

---

## 👨‍💻 Author

**Asad Ali Zia**
Built as a portfolio project for MSc Code and Interactive Systems (Web Engineering) application — FH Salzburg.

---

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
