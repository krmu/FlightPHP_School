# FlightPHP simple example project

As base example was taken Django project, which was modified to work with FlightPHP.
This is a simple project, which has a login system, access control system, and some modules.
This project was created for educational purposes and main goal was to show how to use FlightPHP.
This projects allows to manage students, courses, and marks.
Original project can be found here: https://github.com/krmu/djangouni

# Features
Web: Main project, all addresses
Marks: Marks module. Editing, adding, grade history
Courses: Courses module. Editing, deleting, adding
Students: Students module. Editing, deleting, adding


# Info

Currently system uses SQLite database, which is located in /app/djanogunidb.db.
There are also sql files for creating tables and inserting data, which can be found in /app/djanogunidb.sql

System has such parts students, courses, marks. Since an already prepared DB was used, courses are called modules in English.
The system has a login system, which is based on the darbinieki_user table.

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

## Students averages table
![Averages](/gh_media/all_averages.png "Title")
## All modules
![All modules](/gh_media/all_modules.png "Title")
## Add module
![Add module](/gh_media/add_module.png "Title")
## All staff members
![All staff](/gh_media/all_staff.png "Title")
## All students
![All students](/gh_media/all_students.png "Title")
## Edit student
![Edit students](/gh_media/edit_student.png "Title")
## Edit grade
![Edit students](/gh_media/edit_grade.png "Title")
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
