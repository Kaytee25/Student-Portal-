# NUST Student Portal

This project is a PHP, HTML, CSS, and JavaScript student portal with a MySQL-backed data layer. It supports separate student and admin login flows, student signup, semester registration, fee tracking, assessment uploads, and results management.

## Features

- Role-based login for students and admins
- Database-backed student signup and authentication
- New semester registration with a 50% fee threshold
- Examination results locked until full fees are paid
- Admin forms for fees, continuous assessment, and results updates
- Student dashboard sections for registration, payments, results, and assessment
- MySQL persistence through a small PHP JSON API

## Demo Credentials

Student:

- Student number: `N02529721P`
- Password: `nust1234`

Admin:

- Username: `admin`
- Password: `admin123`

## Requirements

- XAMPP or another local PHP server
- MySQL or MariaDB
- A browser with JavaScript enabled

## How To Run

1. Place the project folder inside your web server root, for example `c:\xampp\htdocs\student_portal_project`.
2. Start Apache and MySQL in XAMPP.
3. Open the portal in your browser at:

   `http://localhost/student_portal_project/index.php`

The first request will create the `student_portal_project` database and seed a demo student and admin account if they do not already exist.

## Database

- Database name: `student_portal_project`
- Student records are stored in the `students` table
- Admin accounts are stored in the `admins` table
- The API endpoint used by the browser is `api.php`

## Project Files

- `index.php` - main application shell and portal UI
- `api.php` - JSON API for login and student data synchronization
- `db.php` - PDO connection, schema setup, and seed helpers
- `styles.css` - portal layout and styling
- `README.md` - project overview and usage notes

## Notes

- The portal now reads initial student data from MySQL instead of `localStorage`.
- If the page looks blank in a browser, make sure you open it through `http://localhost/...` rather than opening the PHP file directly.