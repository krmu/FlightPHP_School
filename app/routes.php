<?php

Flight::group('/', function () {
    Flight::route('/', function () {
        // homepage
        Flight::render('homepage', ['title' => "Home page"], 'saturs');
    }, false, 'home');
    Flight::group('students', function () {
        Flight::route('/all', function () {
            Flight::render('all_students', ['title' => "All students"], 'saturs');
        }, false, 'students_view_all');
        Flight::route('/new_edit(/@student_no)', function ($student_no) {
            Flight::render('students_new_edit', ['title' => "Add or edit student", "student_no" => $student_no], 'saturs');
        }, false, 'students_new_edit');
    });
    Flight::group('grades', function () {
        Flight::route('/edit_grade(/@module_code/@student_no)', function ($module_code, $student_no) {
            Flight::render('grades_edit_add', ['title' => "Add or edit grade", "module_code" => $module_code, "student_no" => $student_no], 'saturs');
        }, false, 'grades_edit_add');
        Flight::route('/all_grades', function () {
            Flight::render('students_grades_overview', ['title' => "All students and grades"], 'saturs');
        }, false, 'students_grades_overview');
    });

    Flight::group('modules', function () {
        Flight::route('/all', function () {
            Flight::render('modules_all', ['title' => "All modules"], 'saturs');
        }, false, 'modules_all');

        Flight::route('/new_edit(/@module_code)', function ($module_code) {
            Flight::render('modules_new_edit', ['title' => "Add or edit module", "module_code" => $module_code], 'saturs');
        }, false, 'modules_new_edit');
    });
    Flight::group('staff_members', function () {
        Flight::route('/all_staff_members', function () {
            Flight::render('all_staff_members', ['title' => "All staff members"], 'saturs');
        }, false, 'all_staff_members');
        Flight::route('/staff_add_edit(/@staff_id)', function ($staff_id) {
            Flight::render('staff_add_edit', ['title' => "Add or edit staff member", "staff_id" => $staff_id], 'saturs');
        }, false, 'staff_add_edit');
    });
}, [new layout_default(), new guard()]);

Flight::route('/no_access', function () {
    Flight::render('no_access', ['title' => "No access"], 'saturs');
}, false, 'noaccess')->addMiddleware([new layout_default()]);

Flight::route('/login', function () {
    Flight::render('login_page', ['title' => "Login"], 'saturs');
}, false, 'login')->addMiddleware([new layout_default()]);
Flight::route('/logout', function () {
    session_destroy();
    Flight::redirect(Flight::get('main_url'));
}, false, 'logout');
