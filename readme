# FlightPHP simple example project

As base example was taken Django project, which was modified to work with FlightPHP.
Original project can be found here: https://github.com/krmu/djangouni

# Features
Web: Main project, all addresses
Marks: Marks module. Editing, deleting, adding
Courses: Courses module. Editing, deleting, adding
Students: Students module. Editing, deleting, adding

# Tables:

students
    id (int 11)
    student_no (varchar 20)
    surname (varchar 20)
    forename (varchar 20)
    active (int 1)
modules
    id (int 11)
    module_code (varchar 8)
    module_name (varchar 50)
    can_have_marks (tinyint 1)
    active (tinyint 1)
marks
    id (int 11)
    student_no (varchar 10)
    module_code (varchar 8)
    mark (int 11)
    last_update (timestamp ON UPDATE CURRENT_TIMESTAMP)
    darbinieki_user
id
    password (varchar 128)
    last_login (datetime)
    username (varchar 255)
    is_active (bool)
    staff (bool)
    admin (bool)
    surname (varchar 255)
    forename (varchar 255)

# Info

Currently system uses SQLite database, which is located in /app/djanogunidb.db.
There are also sql files for creating tables and inserting data, which can be found in /app/djanogunidb.sql

System has such parts students, courses, marks. Since an already prepared DB was used, courses are called modules in English.
The system has a login system, which is based on the darbinieki_user table. The password is hashed with the password_hash function.

The system has a simple access control system.

Employees have two accesses: staff and admin.

staff: Can do everything except manage employees
admin: Can do everything

# Default accounts

admin : password
teacher : teacher

# Installation

1. Clone the repository
2. Run `composer install`
3. Run on server you need. For example `php -S localhost:8000` from folder /public

# Images

Will be added later.

# Project structure

```
/public/ - public folder
    /css/ - css files
    /js/ - js files
    /img/ - images
    index.php - main file
/app/ - main application folder
    /pages/ - pages folder
    config.php - configuration file
    routes.php - routes file
    helpers.php - helper functions
    middlewares.php - middleware functions
```