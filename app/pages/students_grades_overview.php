<?php

$all_active_students = Flight::db()->fetchAll("SELECT * FROM students where aktivs = 1");
$all_active_modules = Flight::db()->fetchAll("SELECT * FROM modules where aktivs = 1");

// Optimization needed
$student_grades = array();
$all_grades = Flight::db()->fetchAll("SELECT * FROM marks");
foreach ($all_grades as $grade) $student_grades[$grade['student_no']][$grade['module_code']] = $grade['mark'];
$subjects_averages = array();
?>
<table class="table table-bordered text-center align-middle">
    <thead class="align-middle table-active">
        <tr>
            <th rowspan="2">Name</th>
            <th rowspan="2">Surname</th>
            <th rowspan="2">Student number</th>
            <th colspan="<?= count($all_active_modules) ?>">Subjects</th>
            <th rowspan=2>Average mark</th>
        </tr>
        <tr>
             
            <?php
            foreach ($all_active_modules as $module) {
                echo " <th>" . $module['module_name'] . "</th> ";
                $subjects_averages[$module['module_code']] = 0;
            }
            ?>
            
        </tr>
    </thead>
    <tbody>
        <?php
        
        foreach ($all_active_students as $student) { ?>
            <tr class="text-center">
                <td class="table-light"><?= $student['forename'] ?></td>
                <td class="table-light"><?= $student['surname'] ?></td>
                <td class="table-light"><?= $student['student_no'] ?></td>
                <?php
                $total_grade = 0;
                $total_modules = 0;
                $has_letter_grade = false;
                foreach ($all_active_modules as $module) {
                    $grade = ((isset($student_grades[$student['student_no']][$module['module_code']])) ? $student_grades[$student['student_no']][$module['module_code']]:false );  
                    $url = Flight::create_full_url('grades_edit_add', array("module_code" => $module['module_code'], "student_no" => $student['student_no']));
                    echo "<td><a class='btn btn-outline-".(($grade)? 'primary':'light text-dark' )."' btn-sm' href='" . $url . "'> ";
                    if ($grade) {
                        if (gettype($grade) == "string") {
                            $has_letter_grade = true;
                        } else {
                            $total_grade += $student_grades[$student['student_no']][$module['module_code']];
                            $subjects_averages[$module['module_code']] += $student_grades[$student['student_no']][$module['module_code']];
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
                        echo "<td class='table-warning fw-bold'>-</td>";
                    } else {
                        echo "<td class='table-warning fw-bold'>" . round($total_grade / $total_modules, 2) . "</td>";
                    }
                } else {
                    echo "<td class='table-warning fw-bold'>-</td>";
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </tbody>
    <tfoot>
        <tr class="table-active">
            <td colspan="3">Average mark</td>
            <?php
            foreach ($all_active_modules as $module) {
                echo "<td class='table-warning fw-bold'>" . round($subjects_averages[$module['module_code']] / count($all_active_students), 2) . "</td>";
            }
            ?>
            <td class='table-warning fw-bold'>-</td>
        </tr>
</table>