# Time-Table-Generator-php
php
# Time Table Generator (PHP)

A web-based system to automatically generate time tables for schools or colleges.  
Built with PHP and MySQL, this project provides a simple interface to create, manage, and view class schedules efficiently.

---

## Features

- Create and manage multiple classes, subjects, and teachers  
- Automatically generate conflict-free time tables  
- User-friendly admin panel for easy configuration  
- Responsive design for various devices  
- Export or print generated time tables

---

## Technologies Used

- PHP 8.x  
- MySQL  
- HTML5, CSS3, JavaScript (for frontend UI)  
- Bootstrap (optional for styling)  

---

## Installation

1. Clone the repository:

```bash
git clone https://github.com/evanssamwel/Time-Table-Generator-php.git
    Import the provided SQL file into your MySQL database:

mysql -u your_username -p your_database < path_to_sql_file.sql

    Update database credentials in admin/includes/dbconnection.php.

    Start PHP's built-in server (for testing):

php -S localhost:8000

    Open your browser and visit http://localhost:8000/ttg or your configured path.

Usage

    Login to the admin panel

    Add classes, subjects, teachers

    Generate the timetable automatically

    View, edit or export the generated timetable
