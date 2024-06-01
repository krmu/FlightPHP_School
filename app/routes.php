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
    },[function() { guard::is_staff(); }]);
    Flight::group('grades', function () {
        Flight::route('/edit_grade(/@module_code/@student_no)', function ($module_code, $student_no) {
            Flight::render('grades_edit_add', ['title' => "Add or edit grade", "module_code" => $module_code, "student_no" => $student_no], 'saturs');
        }, false, 'grades_edit_add');
        Flight::route('/all_grades', function () {
            Flight::render('students_grades_overview', ['title' => "All students and grades"], 'saturs');
        }, false, 'students_grades_overview');
    },[function() { guard::is_staff(); }]);

    Flight::group('modules', function () {
        Flight::route('/all', function () {
            Flight::render('modules_all', ['title' => "All modules"], 'saturs');
        }, false, 'modules_all');

        Flight::route('/new_edit(/@module_code)', function ($module_code) {
            Flight::render('modules_new_edit', ['title' => "Add or edit module", "module_code" => $module_code], 'saturs');
        }, false, 'modules_new_edit');
    },[function() { guard::is_staff(); }]);
    Flight::group('employees', function () {
        Flight::route('/all_employees', function () {
            Flight::render('all_staff_members', ['title' => "All staff members"], 'saturs');
        }, false, 'all_staff_members');
        Flight::route('/employees_add_edit(/@staff_id)', function ($staff_id) {
            Flight::render('staff_add_edit', ['title' => "Add or edit staff member", "staff_id" => $staff_id], 'saturs');
        }, false, 'staff_add_edit');
    },[function() { guard::is_admin(); }]);
    
}, [new layout_default(), new guard()]);

Flight::group('/api', function () {
    Flight::route('/system_stats', function () {
        $students = new Students();
        $marks = new Marks();
        $modules = new Modules();
        $staff = new Staff();
        $student_count = $students->select('COUNT(*) as count')->find()->count;
        $modules_count = $modules->select('COUNT(*) as count')->find()->count;
        $marks_count = $marks->select('COUNT(*) as count')->find()->count;
        $staff_count = $staff->select('COUNT(*) as count')->find()->count;
        return Flight::json(['students' => $student_count, 'modules' => $modules_count, 'marks' => $marks_count, 'staff' => $staff_count]);
    }, false, 'api_system_stats');
    Flight::group('/modules', function () {
        Flight::route('/get_all_list', function () {
            $modules = new Modules();
            $all_modules = $modules->select('module_code, module_name, aktivs')->findAll();
            $return_array = [];
            foreach ($all_modules as $module) {
                $return_array[] = ['module_code' => $module->module_code, 'module_name' => $module->module_name, 'aktivs' => $module->aktivs, "edit_url" => Flight::create_full_url('modules_new_edit', ['module_code' => $module->module_code])];
            }
            return Flight::json($return_array);
        }, false, 'api_modules_get_all_list');
    },);
    Flight::group('/students', function () {
        Flight::route('/get_all_list', function () {
            $students = new Students();
            $all_students = $students->select('forename, surname, student_no, aktivs')->findAll();
            $return_array = [];
            foreach ($all_students as $student) {
                $return_array[] = ['forename' => $student->forename, 'surname' => $student->surname, 'student_no' => $student->student_no, 'aktivs' => $student->aktivs, "edit_url" => Flight::create_full_url('students_new_edit', ['student_no' => $student->student_no])];
            }
            return Flight::json($return_array);
        }, false, 'api_students_get_all_list');
    },[function() { guard::is_staff(true); }]);
},[ new api_guard()]);


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
