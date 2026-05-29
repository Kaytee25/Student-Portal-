# NUST Student Portal

This project is a front-end student portal mockup built with PHP, HTML, CSS, and JavaScript. It includes separate student and admin login flows, a student signup form, fee-based registration logic, results visibility rules, and basic admin tools for updating student records.

## Features

- Role-based login with separate Student and Admin access
- Student signup with saved local account details
- New semester registration with a 50% fee threshold
- Examination results locked until full fees are paid
- Continuous assessment and fee update forms for the admin portal
- Registration, payments, results, and assessment views in the student dashboard
- Client-side persistence using `localStorage`

## Demo Credentials

Student:

- Student number: `N02529721P`
- Password: `nust1234`

Admin:

- Username: `admin`
- Password: `admin123`

## Requirements

- XAMPP or another local PHP server
- A browser with JavaScript enabled

## How To Run

1. Place the project folder inside your web server root, for example `c:\xampp\htdocs\student_portal_project`.
2. Start Apache in XAMPP.
3. Open the portal in your browser at:

	`http://localhost/student_portal_project/index.php`

## Project Files

- `index.php` - main application shell and all portal logic
- `styles.css` - portal layout and styling
- `README.md` - project overview and usage notes

## Notes

- Student data is stored in the browser using `localStorage`.
- The portal is a mockup and does not use a database or backend authentication.
- If the page looks blank in a browser, make sure you open it through `http://localhost/...` rather than opening the PHP file directly.