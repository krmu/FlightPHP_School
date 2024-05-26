<?php

$all_active_students = Flight::db()->fetchAll("SELECT * FROM students where aktivs = 1");
$all_active_modules = Flight::db()->fetchAll("SELECT * FROM modules where aktivs = 1");

// Optimization needed
$student_grades = array();
$all_grades = Flight::db()->fetchAll("SELECT * FROM marks");
foreach ($all_grades as $grade) $student_grades[$grade['student_no']][$grade['module_code']] = $grade['mark'];

?>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Student number</th>
            <?php
            foreach ($all_active_modules as $module) {
                echo " <th>" . $module['module_name'] . "</th> ";
            }
            ?>
            <th>Average mark</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($all_active_students as $student) { ?>
            <tr class="text-center">
                <td><?= $student['forename'] ?></td>
                <td><?= $student['surname'] ?></td>
                <td><?= $student['student_no'] ?></td>
                <?php
                $total_grade = 0;
                $total_modules = 0;
                $has_letter_grade = false;
                foreach ($all_active_modules as $module) {
                    echo "<td><a class='btn btn-outline-primary' btn-sm' href='" . Flight::create_full_url('grades_edit_add', array("module_code" => $module['module_code'], "student_no" => $student['student_no'])) . "'> ";
                    if (isset($student_grades[$student['student_no']][$module['module_code']])) {
                        if (gettype($student_grades[$student['student_no']][$module['module_code']]) == "string") {
                            $has_letter_grade = true;
                        } else {
                            $total_grade += $student_grades[$student['student_no']][$module['module_code']];
                        }
                        echo $student_grades[$student['student_no']][$module['module_code']];

                        $total_modules++;
                    } else {
                        echo "<i class='bi bi-plus-square'></i>";
                    }
                    echo "</a></td>";
                }
                if ($total_modules > 0) {
                    if ($has_letter_grade) {
                        echo "<td class='table-danger'>-</td>";
                    } else {
                        echo "<td>" . round($total_grade / $total_modules, 2) . "</td>";
                    }
                } else {
                    echo "<td>-</td>";
                }
                ?>
            </tr>
        <?php
        }
        ?>
</table>